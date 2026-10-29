<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brand.index', [
            'brands' => $brands
        ]);
        if(!session()->has('AdminID')){

        return redirect()->route('admin.login');

        }
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->all());

        return Redirect::route('brands.index');
    }

    public function show(Brand $brand)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', [
            'brand' => $brand
        ]);
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        return Redirect::route('brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return Redirect::route('brands.index');
    }
}