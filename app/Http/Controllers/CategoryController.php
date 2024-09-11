<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{ 
    use GeneralTrait;

    function index(){
        try{
            $category = Category::all();
            $data = CategoryResource::collection($category);
            if($data){
                return $this->returnData("categories",$data , "categories Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function show($id){
        try{
            $Category = Category::find($id);
            $data= new CategoryResource($Category);
            if($data){
                return $this->returnData("Category",$data , "Category Data");
            }
        }
        catch(\Exception $e){
            return $this->returnError($e ->getMessage() , "can't get data");
        }
    }

    function store(Request $myrequest){
        try{
            Category::create($myrequest->all());
            return $this->returnSuccessMessage("Done,data saved!");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't store data");
        }
    }
    function update(Request $myrequest , $id){
        try{
            $Category = Category::find($id);
            $Category->update($myrequest->all());
            return $this->returnSuccessMessage('Update done');
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "can't update");
        }

    }
    function destroy($id){
        try{
            $Category= Category::find($id);
            $Category->delete();
            return $this->returnSuccessMessage("Delete Done");
        }
        catch(\Exception $e){
            return $this->returnError($e -> getMessage() , "Can't delete");
        }
    }
}
