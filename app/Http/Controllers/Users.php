<?php

namespace App\Http\Controllers;

use App\Models\User ;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;


class Users extends Controller
{
    use GeneralTrait;

    function index(){
        try{
            $users = User::all();
            $data= UserResource::collection($users);
            if($data){
                return $this->returnData("users",$data , "Users Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
        return response()->json(['msg'=>"Error"]);
    }

    function show($id){        
        try{
            $user = User::find($id);
            $data= new UserResource($user);
            if($data){
                return $this->returnData("user",$data , "Data of user");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
        return response()->json(['msg'=>"Error"]);
    }

    function store(Request $myrequest){
      
       try{
            User::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't store data");
        }
    }

    function update(Request $myrequest , $id){
        try{
            $user = User::find($id);
            $user->update($myrequest->all());
            return $this->returnSuccessMessage("Update Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't Update");
        }        
    }
    function destroy($id){
        try{
            $user= User::find($id);
            $user->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
   
}
