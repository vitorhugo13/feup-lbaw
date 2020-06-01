<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Session;

use Intervention\Image\Facades\Image;


use App\Models\User;


class UserController extends Controller
{

    private function validateID($id)
    {
        $data = ['id' => $id];

        $validator = Validator::make($data, [
            'id' => 'required|integer|exists:user',
        ]);

        if ($validator->fails())
            return abort(404);
    }
    /**
     * Shows the card for a given id.
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
        $this->validateID($id);
        $user = User::find($id);
        $this->authorize('showProfile', User::class);

        if ($user == null)
            return abort(404);

        $categories = DB::table("category_glory")->where("user_id", $id)->where("glory", '>', 0)->orderBy("glory", 'DESC')->take(3)->get();

        //TODO: $this->authorize('show', $post);

        return view('pages.profile.show', [
            'user' => $user,
            'categories' => $categories,
        ]);
    }


    /**
     * Shows the edit profile page.
     *
     * @param  int  $id
     * @return Response
     */
    public function showEditProfile($id)
    {
        $this->validateID($id);
        $user = User::find($id);

        $this->authorize('showEditProfile', $user, Auth::user());

        if ($user == null)
            return abort(404);


        //TODO: $this->authorize('show', $post);

        return view('pages.profile.edit', [
            'user' => $user,
        ]);
    }



    /*===================== EDIT PROFILE ============================ */
    // TODO: consider creating a disk in filesystems.php for uploads, may be a good idea, dont know :)

    public function changePhoto(Request $request, $id, MessageBag $mb)
    {

        $this->validateID($id);

        $user = User::find($id);
        if ($user == null)
            return abort(404);
        
        $avatar = $request->file('avatar');

        if($avatar == null){
            $mb->add('avatar', 'Please select a photo...');
            return redirect()->back()->withErrors($mb);
        }

        $extension = $avatar->getClientOriginalExtension();

        if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
            $mb->add('avatar', 'Only .jpg .jpeg or .png allowed.');
            return redirect()->back()->withErrors($mb);
        }

        if($avatar->getSize() > 5000000){
            $mb->add('avatar', 'Maximum file size: 5MB');
            return redirect()->back()->withErrors($mb);
        }

        $path = $user->photo;
        $default = 'storage/uploads/avatars/default.png';

        if ($path != $default) {
            $file = explode("/", $path, 2);
            $exists = Storage::disk('public')->exists($file[1]);

            if($exists){
                Storage::disk('public')->delete($file[1]);
            }
        }



        $img = Image::make($avatar->getRealPath())->fit(400, 400);
        $img->save();

        Storage::disk('public')->put('uploads/avatars/' . $id . '.' . $extension, $img);
        $user->photo = 'storage/uploads/avatars/' . $id . '.' . $extension;
        $user->save();

        
        return redirect()->route('profile', $id)->with('alert-success', 'Profile picture changed successfuly!');
    }

    //TODO: check if this verifications are correct and enough
    public function deletePhoto()
    {
        $id = Auth::user()->id;
        $this->validateID($id);
        $user = User::find($id);
        if ($user == null)
            return abort(404);


        $path = $user->photo;
        $default = 'storage/uploads/avatars/default.png';
       
        if($path != $default){

            $file = explode("/", $path, 2);
            $exists = Storage::disk('public')->exists($file[1]);

            if($exists){
                Storage::disk('public')->delete($file[1]);
                $user->photo = 'storage/uploads/avatars/default.png';
                $user-> save();
            }
        }

        
        Session::flash('alert-success', 'Deleted photo successfully!');
        return response()->json(['success' => "Deleted photo successfully", 'id' => $id], 200);

    }

    public function changeBio(Request $request, $id)
    {
        $this->validateID($id);

        $validator = Validator::make($request->all(), [
            'body' => 'string|min:1',
        ]);

        $errors = $validator->errors();

        if ($validator->fails())
            return redirect()->back()->withInput()->withErrors($errors);

        $user = User::find($id);
        if ($user == null)
            return abort(404);

        $user->bio = $request->input('body');
        $user->save();

        return redirect('users/' . $id)->with('alert-success', "Profile successfully edited!");
    }


    public function changeCredentials(Request $request, $id ,MessageBag $mb)
    {

        $this->validateID($id);
        $modify_pass = false;

        $messages = [
            'username.not_regex' => 'User can not be "anon"',
        ];

        $validator =  Validator::make($request->all(), [
            'username' => 'required|string|max:255|not_regex:/anon/',
            'email' => 'required|email|max:255',
        ], $messages);

        $errors = $validator->errors();


        if ($validator->fails())
            return redirect()->back()->withErrors($errors);


        if (filled($request->input('password'))) {

            $validator2 =  Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
            ]);

            $errors2 = $validator2->errors();


            if ($validator2->fails())
                return redirect()->back()->withErrors($errors2);

            $modify_pass = true;
        }



        $user = User::find($id);
        if ($user == null)
            return abort(404);


        $old_username = $user->username;
        $old_email = $user->email;


        if ($old_username != $request->input('username')) {
            $users = User::where('username', $request->input('username'))->get();

            if (count($users) > 0) {
                $mb->add('username', 'Username "' . $request->input('username') . '" already taken');
                return redirect()->back()->withErrors($mb);
            }

            $user->username = $request->input('username');
            $user->save();
        }

        if ($old_email != $request->input('email')) {
            $users = User::where('email', $request->input('email'))->get();

            if (count($users) > 0) {
                $mb->add('email', 'Email already associated with another account');
                return redirect()->back()->withErrors($mb);
            }

            $user->email = $request->input('email');
            $user->save();
        }

        if ($modify_pass) {

            $old_password = $request->input('old_pass');
            error_log($old_password);
            $hasher = app('hash');

            //FIXME: the following condition may not be right - user->password is not yet the new password
            if (!$hasher->check($old_password, $user->password)) {
                $mb->add('old_pass', 'Old password not correct');
                return redirect()->back()->withErrors($mb);
            }

            $user->password = bcrypt($request->input('password'));
            $user->save();
        }


        return redirect('users/' . $id)->with('alert-success', "Profile successfully edited!");
    }

    public function getNotifications(Request $request) {
        $notifications = Auth::user()->notifications;
        return response()->json(['success' => "Retrieved notifications", 'notifications' => $notifications], 200);
    }

    /*===================== CHANGE PERMISSIONS ============================ */
    public function changePermissions(Request $request, $id) {
        $this->authorize('changePermissions', Auth::user());

        $new_role = $request->input('role');

        $validator =  Validator::make($request->all(), [
            'role' => array(
                'required',
                'string',
                'regex:/(Moderator)|(Member)/'
                )
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $user = User::find($id);

        if($user->role != $new_role) {
            $user->role = $new_role;
            $user->save();
        }

        return response()->json(['success' => "User " . $user->username . " is now a " . $new_role], 200);
    }
    
    public function block(Request $request, $id) {
        $user = User::find($id);
        $this->authorize('block', Auth::user(), $user);

        $time = $request->input('time');

        $validator =  Validator::make($request->all(), [
            'time' => array(
                'required',
                'numeric',
                'between:24,8760'
                )
        ]);

        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        //TODO: time logic
        $user->save();

        return response()->json(['success' => "User " . $user->username . " is now Blocked"], 200);
    }

    public function delete($id){
        $user = User::find($id);
        $this->authorize('delete', $user);
        $user->delete();

        return redirect('home')->with('alert-success', "Profile was deleted!");
    }
}
