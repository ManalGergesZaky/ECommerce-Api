<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    use GeneralTrait;

    public function index(){
        try{
            $order = Order::all();
            $data = OrderResource::collection($order);
            if($data){
                return $this->returnData("Orders",$data , "Orders Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }
    public function show($id){
        try{
            $order = Order::find($id);
            $data= new OrderResource($order);
            if($data){
                return $this->returnData("Order",$data , "Order Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            Order::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
        
    }
    function update(Request $myrequest , $id){
        try{
            $order = Order::find($id);
            $order->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }
    }
    function destroy( $id){
        
        try{
            $order = Order::find($id);
            $order->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
}
