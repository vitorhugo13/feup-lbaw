<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\MessageBag;

use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\User;


class UserController extends Controller
{

    //TODO: validate the ids everywhere in this controller
    //TODO: we can only edit a profile if we are logged in that account
    private function validateID($id)
    {
        $data = ['id' => $id];

        $validator = Validator::make($data, [
            'id' => 'required|integer|exists:content',
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
        $user = User::find($id);
        if ($user == null)
            return abort(404);


        //TODO: $this->authorize('show', $post);

        return view('pages.profile.edit', [
            'user' => $user,
        ]);
    }



    /*===================== EDIT PROFILE ============================ */

    //TODO: CHANGE POLICIES -> everyone is capable of edit profile of other users :'(
    public function changePhoto(Request $request, $id)
    {
        // TODO: check if the user exists
        // TODO: only .jpg and .png photos
        // TODO: if we do "Change photo" without any file it's returning error
        // FIXME: no restrictions to the uploaded file
        // FIXME: photos have to be "cut", so all photo have the same width*length
        $avatar = $request->file('avatar');
        $extension = $avatar->getClientOriginalExtension();

        // TODO: consider creating a disk in filesystems.php for uploads, may be a good idea, dont know :)
        Storage::disk('public')->put('uploads/avatars/' . $id . '.' . $extension, File::get($avatar));

        $user = User::find($id);
        $user->photo = asset('storage/uploads/avatars/' . $id . '.' . $extension);
        $user->save();

        return redirect()->route('profile', $id)->with('alert-success', 'Profile picture changed successfuly!');
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

}
