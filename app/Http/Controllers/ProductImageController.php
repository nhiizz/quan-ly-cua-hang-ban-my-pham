<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use Illuminate\Support\Facades\Redirect;

class ProductImageController extends Controller
{
    public function index()
    {
        $images = ProductImage::with('product')->get();

        return view('admin.productimage.index', [
            'images' => $images
        ]);
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.productimage.create', [
            'products' => $products
        ]);
    }

public function store(StoreProductImageRequest $request)
{
    $imageName = null;

    if ($request->hasFile('ImageURL')) {

        $image = $request->file('ImageURL');

        $imageName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('images'), $imageName);
    }

    ProductImage::create([
        'ProductID' => $request->ProductID,
        'ImageURL' => $imageName,
        'IsMainImage' => $request->IsMainImage,
    ]);

    return redirect()->route('productimages.index');
}

    public function show(ProductImage $productimage)
    {

    }

    public function edit(ProductImage $productimage)
    {
        $products = Product::all();

        return view('admin.productimage.edit', [
            'productimage' => $productimage,
            'products' => $products
        ]);
    }

    public function update(UpdateProductImageRequest $request, ProductImage $productimage)
{
    $imageName = $productimage->ImageURL;

    if ($request->hasFile('ImageURL')) {

        $imageName = time().'.'.$request->ImageURL->extension();

        $request->ImageURL->move(
            public_path('images'),
            $imageName
        );
    }

    $productimage->update([

        'ProductID' => $request->ProductID,

        'ImageURL' => $imageName,

        'IsMainImage' => $request->IsMainImage

    ]);

    return redirect()->route('productimages.index');
}

    public function destroy(ProductImage $productimage)
    {
        $productimage->delete();

        return Redirect::route('productimages.index');
    }
}