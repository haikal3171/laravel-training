<?php

// CoronaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('image'))
        {
            $this->validate($request ,[
                'name' => 'required|max:255|unique:products',
                'description' => 'required',
                'count' => 'required|numeric',
                'price' => 'required',
                'image' => 'required|image|mimes:jpg,png,gif|max:2048'
            ]);
            
            $image = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $image);

            Product::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'count'=>$request->input('count'),
                'price'=>$request->input('price'),
                'image' => $image
            ]);
        }
        else
        {
            $this->validate($request, [
                'name' => 'required|max:255|unique:products',
                'description' => 'required',
                'count' => 'required|numeric',
                'price' => 'required'
            ]);

            Product::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'count'=>$request->input('count'),
                'price'=>$request->input('price')
            ]);
        }

        // return redirect('/products')->with('success', 'Product has been successfully saved');

        Session::flash('message','Product successfully created!');
        Session::flash('aler-class','alert-success');

        return back();

        // $data = $request->validate([
        //     'name' => 'required|max:255|unique:products',
        //     'description' => 'required',
        //     'count' => 'required|numeric',
        //     'price' => 'required',
        //     'image' => 'image|mimes:jpg,png,gif|max:2048'
        // ]);

        // if($request->file('image')){
        //     $filename = time().'.'.$request->image->extension();
        //     $request->image->move(public_path('images'), $image);
        // }

        // $data = array(
        //     'name' => $data['name'],
        //     'description' => $data['description'],
        //     'count' => $data['count'],
        //     'price' => $data['price'],
        //     'image' => $filename
        // );

        // Product::create($data);

        // return redirect('/products')->with('success', 'Product has been successfully saved');
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
        $product = Product::findOrFail($id);

        return view('products.edit', compact('product'));
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
        if($request->file('image'))
        {
            $this->validate($request ,[
                'name' => 'required|max:255|unique:products',
                'description' => 'required',
                'count' => 'required|numeric',
                'price' => 'required',
                'image' => 'required|image|mimes:jpg,png,gif|max:2048'
            ]);

            $old_image = $request->old_image;
            $request->image->move(public_path('images'), $old_image);

            Product::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'count'=>$request->input('count'),
                'price'=>$request->input('price'),
                'image' => $old_image
            ]);
        }
        else
        {
            $this->validate($request, [
                'name' => 'required|max:255|unique:products',
                'description' => 'required',
                'count' => 'required|numeric',
                'price' => 'required'
            ]);

            Product::create([
                'name'=>$request->input('name'),
                'description'=>$request->input('description'),
                'count'=>$request->input('count'),
                'price'=>$request->input('price')
            ]);
        }

        // return redirect('/products')->with('success', 'Product has been successfully updated');

        Session::flash('message','Product successfully updated!');
        Session::flash('aler-class','alert-success');

        return back();
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
        $product->delete();

        // return redirect('/products')->with('success', 'Product has been successfully deleted');

        Session::flash('message','Product successfully deleted!');
        Session::flash('aler-class','alert-success');

        return back();
    }
}