<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Reviews;
use Auth;
use Session;
use Log;
use Illuminate\Support\Facades\Input;
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
        Session::forget('cart');
        
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
            'photos'=>'required'

            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
             if($request->hasFile('photos')){
                $allowedfileExtension=['jpg','jpeg','png'];
                $files=$request->file('photos');
                foreach($files as $file){
                    $filename=$file->getClientOriginalName();
                    $extension=$file->getClientOriginalExtension();
                    $check=in_array($extension,$allowedfileExtension);
                    //dd($check);
                    if($check){
                    
                             $file->move(public_path('images'), $filename);
                                $input['name'] = $request->name;
                                 $input['price']=$request->price;
                                 $input['discount']=$request->discount;
                                 $input['stock']=$request->stock;
                                 $input['image']=$filename;
                                 $data=[
                                 'type'=>$request->type,
                                 'country'=>$request->country
                                ];
                                $data=json_encode($data);
                                 $input['description']=$data;
                        Product::create($input);
                        }
                        }  

                         return back()

             ->with('success','Product Uploaded successfully.');

                    }
                    else{
                        echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                    }
                }
             

    
    public function show($id)
   
    {
        $product=Product::findOrFail($id);
        return view('details',compact('product'));
    }

    public function reviews(Request $request,$id){
        //$product=Product::get();
        $input['product_id']=$id;
        $input['reviews']=$request->reviews;
        Reviews::create($input);
        return back()->with('success','Review added successfully');


    }
   
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        return view('edit',compact('product'));
    }

   
    public function update(Request $request, $id)
    {
       $product=Product::findOrFail($id);
       $request->validate([
        'name' => 'required',
        'price'=>'required|integer',
       ]);
       $product->name=$request->name;
       $product->price=$request->price;
       $product->discount=$request->discount;
       $product->stock=$request->stock;
       //dd($request->image);
        $images = Input::file('image');
    if (Input::hasfile('image')) {
         $image_path = public_path("images/{$product->image}");
            unlink($image_path);
             $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
         $filename  = $images->getClientOriginalName();
            $images->move(public_path('images'), $filename);
            $product->image = $filename;

        }            
            $product->save();

            return redirect()->route('products.show',$id)
                ->with('success', 'Product Updated');
        }
    
    

    public function addTocart(Request $request,$id){

        $cart = Session::get('cart');
        $cart[$id] = [
        "id" => $request->id,
        "name" => $request->name,
        "price" => $request->price,
        "qty" => $request->qty
    ];
  

    Session::put('cart', $cart);
   echo view('cart');
 
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
         $image_path = public_path("images/{$products->image}");
         //dd($image_path);
         if (\File::exists($image_path)) {
             
            unlink($image_path);
    }
        $products->delete();
        return back();
    }

    
}
