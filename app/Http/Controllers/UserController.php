<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
            'body' => 'string|min:1',
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

    //TODO: verificar o que se passa com o back with input
    //nao está a fazer nada a cena das credenciais ...

    public function changeCredentials( Request $request, $id)
    {

        $this->validateID($id);
        $modify_pass = false;

        $validator =  Validator::make($request->all(), [
            'username' => 'required|string|max:255|not_regex:/anon/',
            'email' => 'required|email|max:255',
        ]);


        if ($validator->fails())
            return redirect()->back();


        if(filled($request->input('password'))){

            $validator2 =  Validator::make($request->all(), [
                'password' => 'required|string|min:6|confirmed',
            ]);


            if($validator2->fails())
                return redirect()-> back();

            $modify_pass = true;
        }

        
        
        $user = User::find($id);
        if ($user == null)
            return abort(404);


        $old_username = $user->username;
        $old_email = $user->email;


        if($old_username != $request->input('username')){
            $users = User::where('username', $request->input('username'))->get();

            if(count($users) > 0){
               return redirect()->back();
            }

            $user->username = $request->input('username');
            $user->save();
        }

        if($old_email != $request->input('email')){
            $users = User::where('email', $request->input('email'))->get();

            if (count($users) > 0){
                return redirect()->back();
            }

            $user->email = $request->input('email');
            $user->save();
        }

        if($modify_pass){

            $old_password = $request->input('old_pass');
            $hasher = app('hash');
            if (!$hasher->check($old_password, $user->password)) {
                return redirect()->back();
                
            }
            
            $user->password = bcrypt($request->input('password'));
            $user->save();
        }


       return redirect('users/' . $id);

    }
}
