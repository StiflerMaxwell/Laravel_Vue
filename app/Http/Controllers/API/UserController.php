<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UserRequest;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function __construct()
    {
        $this->middleware('auth:api');
    }




    public function index()
    {


        $this->authorize('isAdmin');

         return User::latest()->paginate(10);
         //$users = User::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->authorize('isAdmin');

        $this->validate($request,[

            'name' => 'required|string|max:191',
            'email' => 'required|string|email|unique:users|max:191',
            'password' => 'required|string|min:6',
            'type' => 'required|string|max:191'
 

        ]);


        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'type' => $request['type'],
        ]);

        return  'User Created Successfully';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }



    public function profile()
    {
        //

        $response = [
            'success' => true,
            'data'    => auth('api')->user(),
            'message' => 'User Profile',
        ];
        return response()->json($response, 200);
        
    }




    public function UpdateProfile(Request $request)
    {
        $user = auth('api')->user();

      
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:6'
        ]);


        $currentPhoto = $user->photo;


        if($request->photo != $currentPhoto){
            //$name = time().'.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            $extension = explode('/', mime_content_type($request->photo))[1];
            $name = time().'.'.$extension;

             
            \Image::make($request->photo)->save(public_path('img/profile/').$name);
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;
            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }


            $user->photo = $name;
             $user->save();

        }

         
        $user->update($request->all());
        

       

        return ['message' => "Profile has been updated"];

        /* $response = [
            'success' => true,
            'data'    => $user,
            'message' => 'Profile has been updated',
        ];
        return response()->json($response, 200); */
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Users\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        User::find(auth('api')->user()->id)->update(['password' => Hash::make($request->new_password)]);

        $response = [
            'success' => true,
            'data'    => [],
            'message' => 'Password Has been updated',
        ];
        return response()->json($response, 200);
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->authorize('isAdmin');

        
         $user = User::findOrFail($id);

         $this->validate($request,[

            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6',
            'type' => 'required|string|max:191'
 

        ]);

        $user->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $this->authorize('isAdmin');


        $user = User::findOrFail($id);
        // delete the user

        $user->delete();

        return 'User deleted !';
    }
}
