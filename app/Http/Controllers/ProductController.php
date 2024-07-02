<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index() //get all product frome the database
    {
        $products = Product::all();
        return view('index', compact('products')); //return view all product
    }

    public function create()//open the create  form hitting this function
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([ //validate all object come frome the request
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Product::create($request->all()); //create new object come in the request and save the database
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)// show the product from the database by product id
    {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }
    //edite the product open edit form 
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('edit', compact('product'));
    }
    //validate the product come in request and update and save the database 
    public function update(Request $request, $id)
    {
        $request->validate([//validate the product 
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);
        //find product by id in database using eloquent and sending success msg
        $product = Product::findOrFail($id);
        $product->update($request->all());//update all field come in the request
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }
    // delete product by his id come in request 
    public function destroy($id)
    {
        //find product by id in database using eloquent 
        $product = Product::findOrFail($id);
        $product->delete();//Delete the product model from the database
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
