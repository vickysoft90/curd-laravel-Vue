<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $page_offset = $request->has('page') ? $request->get('page') : 0;
       $page_limit = $request->has('page_count') ? $request->get('page_count') : 5;
        $productArrary=[];

        $product_ids = Product::skip($page_offset*$page_limit)
        ->take($page_limit)
        ->orderBy('products.id','ASC')
        ->get();
        $product_array = $product_ids->toArray();
        $product_ids_array = array_column($product_array,"id");
        

        $products = Product::leftjoin('categories','categories.id','=','products.category_id')
        ->leftjoin('product_tags','product_tags.product_id','=','products.id')
        ->leftjoin('tags','product_tags.tag_id','=','tags.id')
        ->select( 'categories.title','products.*','tags.title as tag_name')
        ->whereIn('product_tags.product_id',$product_ids_array)
        ->where('categories.stat','A')
        ->orderBy('products.id','ASC')
        ->get();


        $uniqueValues = array(); // This array will store unique values based on 'id'
        $productsTags = array();
        $duplicateArray = array();  // To store duplicate items
        $uniqueArray = array();
                foreach ($products as $item) {
                    $id = $item['id'];
                    if (!isset($uniqueArray[$id])) {
                        $uniqueArray[$id] = $item;
                    } else {
                        if (!isset($duplicateArray[$id])) {
                        $duplicateArray[$id] = $item['tag_name'];
                        }else{
                        $duplicateArray[$id] = $duplicateArray[$id].",". $item['tag_name'];
                        }
                    }
                }
                $uniqueArray = array_values($uniqueArray);
                foreach ($uniqueArray as $item) {
                    $id = $item['id'];
                    if (!isset($productsTags[$id])) {
                        $productsTags[$id] = $item;
                        if(isset($duplicateArray[$id])){
                            $item['tag_name'] = $item['tag_name'].",".$duplicateArray[$id];
                            $productsTags[$id] = $item;
                        }
                    } 
                }   
                
        return response()->json($uniqueArray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->post())->id;
        if($request->tag_id!=""){
        $tagArray = explode(",",$request->tag_id);
        foreach($tagArray as $val){
                DB::table('product_tags')->insertGetId(
                [
                    'product_id' => $product,
                    'tag_id' => $val
                ]
                );
            }
        }
        return response()->json([
            'message' => 'Product Created Successfully!!!',
            'product' => $product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $tagArray = explode(",",$request->tag_id);
       // $input = $request->except(['tag_id']);
        $product->fill($request->post())->save();
        $id=$product->getAttributes();
        DB::table('product_tags')->where('product_id',$id['id'])->delete();
        if($request->tag_id!=""){
            foreach($tagArray as $val){
                DB::table('product_tags')->insertGetId(
                [
                    'product_id' => $id['id'],
                    'tag_id' => $val
                ]
                );
            }
        }
        return response()->json([
            'message' => 'Product Updated Successfully!!!',
            'product' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Product Deleted Successfully!!!'
        ]);
    }
}