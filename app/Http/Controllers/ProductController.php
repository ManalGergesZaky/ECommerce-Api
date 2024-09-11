<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    use GeneralTrait;
    
    function index(){
        try{
            $products = Product::select(
                "id",
                "name",
                "price",
                "quantity",
                "details",
                "cat_id",
                "image",
                \DB::raw("('SELECT image') AS image_path"),
            )
            ->with("category")->get();
            $data = ProductResource::collection($products);
            if($data){
                return $this->returnData("products",$data , "Products Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function show($id){
        try{
            $product = Product::find($id);
            $data= new ProductResource($product);
            if($data){
                return $this->returnData("product",$data , "Product Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            Product::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
        
    }

    function destroy($id){
        try{
            $product = Product::find($id);
            $product->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
    function update(Request $myrequest , $id){
        try{
            $product = Product::find($id);
            $product->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }

    }
    
    
}
