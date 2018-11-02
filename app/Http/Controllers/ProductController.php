<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Reviews;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($locale)
    {   
        app()->setLocale($locale);
        $products=Product::get();
        return view('products',compact('products'));
    }

    public function product()
    {   
        $products=Product::get();
        return view('products',compact('products'));
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

            $this->validate($request, [
              
            'name' => 'required',
            'price'=>'required|integer',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $input['image'] = time().'.'.$request->image->getClientOriginalExtension();

        $request->image->move(public_path('images'), $input['image']);
       // $request->image->storeAs('images',$input['image']);


        $input['name'] = $request->name;
        $input['price']=$request->price;
        $input['discount']=$request->discount;
        $input['stock']=$request->stock;

        Product::create($input);


        return back()

            ->with('success','Product Uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products=Product::findOrFail($id);

        $result = array(
            'products' => $products,
        );
        return view('details',compact('result'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function reviews(Request $request,$id){
        //$product=Product::get();
        $input['product_id']=$id;
        $input['reviews']=$request->reviews;
        Reviews::create($input);
        return back()->with('success','Review added successfully');

    }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products =Product::findOrFail($id);
        $products->delete();
        return back();
    }
}
