<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();

        return view('admin.product.index', [
            'products' => $products
        ]);
        if(!session()->has('AdminID')){

        return redirect()->route('admin.login');

        }
    }

    /**
     * Hiển thị form thêm
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.create', [
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Lưu sản phẩm
     */
    public function store(StoreProductRequest $request)

    {

        $data = $request->all();


        $data['Price'] = $request->Price * 1000;

        if ($request->DiscountPrice) {

            $data['DiscountPrice'] = $request->DiscountPrice * 1000;

        }

        Product::create($data);

        return Redirect::route('products.index')

            ->with('success', 'Thêm sản phẩm thành công!');

    }

    public function show(Product $product)
    {

    }

    /**
     * Hiển thị form sửa
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.product.edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Cập nhật
     */
    public function update(UpdateProductRequest $request, Product $product)

    {

        $data = $request->all();

        // Nếu nhập 150 thì lưu thành 150000

        $data['Price'] = $request->Price * 1000;

        if ($request->DiscountPrice) {

            $data['DiscountPrice'] = $request->DiscountPrice * 1000;

        }

        $product->update($data);

        return Redirect::route('products.index')

            ->with('success', 'Cập nhật sản phẩm thành công!');

    }

    /**
     * Xóa
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return Redirect::route('products.index');
    }
}