<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use App\Models\User;

class UserController extends Controller
{

    // TODO: validate the ids everywhere in this controller
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
        $user = User::find($id);
        if ($user == null)
            return abort(404);


        //TODO: $this->authorize('show', $post);

        return view('pages.profile.show', [    
            'user' => $user,   
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
        // FIXME: no restrictions to the uploaded file
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
            'body' => 'string',
        ]);

        if ($validator->fails())
            return redirect()->back()->withInput();

        $user = User::find($id);
        if ($user == null)
            return abort(404);

        $user->bio = $request->input('body');
        $user->save();

        return redirect('users/' . $id);

    }


    public function changeCredentials()
    {
        return redirect('posts/3');

    }
}
