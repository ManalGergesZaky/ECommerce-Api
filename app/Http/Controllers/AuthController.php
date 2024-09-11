<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use GeneralTrait;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }


    public function login(Request $request) {
        // $validated = $request->validate([
        //     'email'=>'required'|'email',
        //     // 'password'=>['required','min:9'],
        // ],
        // ['email.required'=> 'Please Enter Your Email']
        // );
        // if($validated->fails()){
        //     return $this->returnError(404,$validated->errors());
        // }
        try {
            $credentials = $request->only("email", "password");
            $token = auth::guard('api')->attempt($credentials);
            // dd($token);
            // If token generation fails, return error
            if (!$token) {
                return $this->returnError(401 , "Invalid credentials");
            }
    
            $user = auth::guard('api')->user();
    
            // Ensure user is authenticated before assigning token
            if (!$user) {
                return $this->returnError(404 , "User not found");
            }
    
            // Attach token to the user response
            $user->token = $token;
            return $this->returnData("user", $user,"Done");
        } catch (\Exception $e) {
            return $this->returnError(500 , $e->getMessage());
        }
    }
    

    public function register(Request $request){
        $user = User::create([
            'first_name'=> $request->first_name,
            'last_name'=> $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
            'phone'=>   $request->phone,
            'addres'=>$request->addres ,
        ]);

        if($user){
            return $this->login($request);
        }
        return $this->returnError(400 , 'something wrong');
    }
    
    public function logout(Request $request){
        try{
            //remove token
            JWTAuth::invalidate(JWTAuth::getToken($request->token));
            return $this->returnSuccessMessage('User signed out ');
        }
        catch(\Exception $e){
            // dd($e);
            return $this->returnError(400 , $e->getMessage());
        }

    }

    public function user_profile(){
        $user = new UserResource(auth()->user());
        // return response()->json(new UserResource(auth()->user()));
        return $this->returnData("user profile", $user,"success");
    }

    public function refresh_token(){
        try{
            $token= auth()->refresh();
            return $this->returnData("New Token", $token,"refresh done");
        }
        catch(\Exception $e){
            return $this->returnError(400 , $e->getMessage());
        }
        
    }
    
}
