<?php

namespace App\Http\Controllers;

use App\Models\CartDetail;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\CartDetailResource;

class CartDetailController extends Controller
{
    use GeneralTrait;

    public function index(){
        try{
            $cart = CartDetail::all();
            $data = CartDetailResource::collection($cart);
            if($data){
                return $this->returnData("carts Details",$data , "Carts Details Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }
    public function show($id){
        try{
            $cart = CartDetail::find($id);
            $data= new CartDetailResource($cart);
            if($data){
                return $this->returnData("cartDetails",$data , "Cart Details Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            CartDetail::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
        
    }
    function update(Request $myrequest , $id){
        try{
            $cart = CartDetail::find($id);
            $cart->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }
    }
    function destroy( $id){
        try{
            $cart = CartDetail::find($id);
            $cart->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
}
