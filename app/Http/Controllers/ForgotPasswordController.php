<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request){
        $input=$request->only('email');
        $user=User::where('email',$input)->first();
        $user->notify(new ResetPasswordNotification());
        $success['succees']=true;
        return response()->json($success,200);
    }
}
