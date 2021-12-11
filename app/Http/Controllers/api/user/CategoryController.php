<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\{User,Product,Category};

class CategoryController extends Controller
{

    public $successStatus = 200;
    public $unauthorizedStatus = 401;
    public $badRequest = 400;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::guard('api')->user();
        $category = Category::all();

        if(count($category)) {
            $response_arr = array(
                    'status'=>true,
                    'message'=>"category list.",
                    'result' => $category
            );
        } else {
            $response_arr = array(
                    'status'=>true,
                    'message'=>"There is no category available at this time.",
                    'result' => $category
            );
        }
        return response()->json($response_arr, $this->successStatus);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::guard('api')->user();

        $validator = Validator::make($request->all(), [
                'name' => 'required',
        ]);
        if ($validator->fails()) {
            $response_arr = array(
                    'status'=>false,
                    'message'=>$validator->errors()
            );
            return response()->json($response_arr, $this->successStatus);
        } 

        $category = new Category();
        $category->fill($request->all());

        if($category->save()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Category created successfully.'
                );
        }else{
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Something went wrong.'
                );
        }

        return response()->json($response_arr, $this->successStatus); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::findOrFail($id);

        if($product->save()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'category details',
                        'result' => $category
                );
        }else{
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Something went wrong.'
                );
        }
            
        return response()->json($response_arr, $this->successStatus);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;

        if($category->save()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'category updated successfully',
                );
        }else{
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Something went wrong.'
                );
        }
            
        return response()->json($response_arr, $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if($category->delete()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'category deleted successfully',
                );
        }else{
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Something went wrong.'
                );
        }
            
        return response()->json($response_arr, $this->successStatus);
    }

}