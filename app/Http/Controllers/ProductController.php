<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
public function index()
{
    $products = Product::orderBy('id', 'desc')->paginate(12);  // Eloquent ORM method to query the Product model, order the results by ID in descending order, and paginate the results with 12 products per page

    if(request()->is('admin/*'))
    {
        if(!auth()->check() || !auth()->user()->is_admin){
            abort(403);
        }
        return view('admin.products', compact('products'));
    }

    return view('products.index', compact('products'));
}

public function show($id)
{
    $product = Product::findOrFail($id);//elaquent ORM method to find a product by its ID or fail with a 404 error if not found
    return view('products.show', compact('product'));
}


public function create()
{
    if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }
    return view('admin.create-product');
}


public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'images' => 'nullable|array',
        'images.*' => 'image|max:2048'
    ]);

    if($request->hasFile('images')){
        $imagePaths = [];
        foreach($request->file('images') as $file){
            $path = $file->store('products', 'public');
            $imagePaths[] = '/storage/'.$path;
        }
        $data['images'] = $imagePaths;
        if(count($imagePaths) > 0){
            $data['image'] = $imagePaths[0];
        }
    }

    if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }

    Product::create($data);  // Eloquent ORM method to create a new product in the database with the validated data from the request

    return redirect('/admin/products')->with('success','Product created.');
}

public function edit($id)
{
    if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }
    $product = Product::findOrFail($id);//elaquent ORM method to find a product by its ID or fail with a 404 error if not found
    return view('admin.edit-product', compact('product'));
}

public function update(Request $request, $id)
{
    if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }
    $product = Product::findOrFail($id);// Eloquent ORM method to find a product by its ID or fail with a 404 error if not found

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'images' => 'nullable|array',
        'images.*' => 'image|max:2048'
    ]);

    if($request->hasFile('images')){
        // remove old images
        if($product->images){
            foreach($product->images as $img){
                $old = public_path(ltrim($img, '/'));
                if(file_exists($old)) @unlink($old);
            }
        }
        // remove old local single image if it wasn't part of images array
        if($product->image && str_starts_with($product->image, '/images/')){
            $old = public_path(ltrim($product->image, '/'));
            if(file_exists($old)) @unlink($old);
        }
        
        $imagePaths = [];
        foreach($request->file('images') as $file){
            $path = $file->store('products', 'public');
            $imagePaths[] = '/storage/'.$path;
        }
        $data['images'] = $imagePaths;
        if(count($imagePaths) > 0) {
            $data['image'] = $imagePaths[0];
        }
    }

    $product->update($data);

    return redirect('/admin/products')->with('success','Product updated.');
}

public function destroy($id)
{
    if(!auth()->check() || !auth()->user()->is_admin){ abort(403); }
    $product = Product::findOrFail($id);// Eloquent ORM method to find a product by its ID or fail with a 404 error if not found
    if($product->images){
        foreach($product->images as $img){
            $old = public_path(ltrim($img, '/'));
            if(file_exists($old)) @unlink($old);
        }
    }
    if($product->image && str_starts_with($product->image, '/images/')){
        $old = public_path(ltrim($product->image, '/'));
        if(file_exists($old)) @unlink($old);
    }
    $product->delete();
    return back()->with('success','Product deleted.');
}

}
