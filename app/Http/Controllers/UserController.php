<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\User;





class UserController extends Controller
{

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
        return abort(404);

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
