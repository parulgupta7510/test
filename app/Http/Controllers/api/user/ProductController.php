<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\{User,Product,Category,Product_Category};

class ProductController extends Controller
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
        $product = Product::all();

        if(count($product)) {
            $response_arr = array(
                    'status'=>true,
                    'message'=>"product list.",
                    'result' => $product
            );
        } else {
            $response_arr = array(
                    'status'=>true,
                    'message'=>"There is no product available at this time.",
                    'result' => $product
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
                'price' => 'required',
        ]);
        if ($validator->fails()) {
            $response_arr = array(
                    'status'=>false,
                    'message'=>$validator->errors()
            );
            return response()->json($response_arr, $this->successStatus);
        } 


        $product = new Product();
        $product->fill($request->all());

        if($product->save()) {
                $category =  Category::findOrFail($request->category_id);

                if(!empty($category)) {
                    $productCategory =  new Product_Category();
                    $productCategory->product_id = $product->id;
                    $productCategory->category_id = $request->category_id;
                    $productCategory->save();
                }
                $response_arr = array(
                        'status'=>true,
                        'message'=>'Product created successfully.'
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        if($product->save()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'product details',
                        'result' => $product
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
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;

        if($product->save()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'product updated successfully',
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
        $product = Product::findOrFail($id);

        if($product->delete()) {
                $response_arr = array(
                        'status'=>true,
                        'message'=>'product deleted successfully',
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
