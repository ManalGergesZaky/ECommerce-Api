<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use GeneralTrait;
    private $otp;

    public function __construct(){
        $this->otp=new Otp();
    }
    
    public function resetPassword(Request $request){
        $otp2=$this->otp->validate($request->email,$request->otp);
        // dd($otp2->status);
        if(! $otp2->status){
            return $this->returnError(401 , "Error in Code");
        }
        $user=User::where('email',$request->email)->first();
        $user->update(
            [
                'password'=>Hash::make($request->password)
            ]
        );
       $user->tokens()->delete();
        return $this->returnSuccessMessage('Reset Password Done');
    }
}
