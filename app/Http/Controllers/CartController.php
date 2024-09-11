<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\CartResource;

class CartController extends Controller
{
    use GeneralTrait;

    public function index(){
        try{
            $cart = Cart::all();
            $data = CartResource::collection($cart);
            if($data){
                return $this->returnData("carts",$data , "carts Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }
    public function show($id){
        try{
            $cart = Cart::find($id);
            $data = new CartResource($cart);
            if($data){
                return $this->returnData("cart",$data , "cart Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            Cart::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
        
    }
    function update(Request $myrequest , $id){
        try{
            $cart = Cart::find($id);
            $cart->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }
    }
    function destroy( $id){
        try{
            $cart = Cart::find($id);
            $cart->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
}
