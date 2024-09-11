<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\OrderDetailResource;

class OrderDetailController extends Controller
{
    use GeneralTrait;

    public function index(){
        try{
            $order = OrderDetail::all();
            $data = OrderDetailResource::collection($order);
            if($data){
                return $this->returnData("ordersDetails",$data , "ordersDetails Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }
    public function show($id){
        try{
            $order = OrderDetail::find($id);
            $data= new OrderDetailResource($order);
            if($data){
                return $this->returnData("orderDetails",$data , "orderDetails Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            OrderDetail::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
        
    }
    function update(Request $myrequest , $id){
        try{
            $order = OrderDetail::find($id);
            $order->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }
    }
    function destroy( $id){
        try{
            $order = OrderDetail::find($id);
            $order->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
}
