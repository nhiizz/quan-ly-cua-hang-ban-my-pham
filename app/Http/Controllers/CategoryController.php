<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', [
            'categories' => $categories
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
        return view('admin.category.create');
    }

    /**
     * Lưu dữ liệu
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->all());

        return Redirect::route('categories.index');
    }

    /**
     * Không sử dụng
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Hiển thị form sửa
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Cập nhật
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return Redirect::route('categories.index');
    }

    /**
     * Xóa
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index');
    }
}