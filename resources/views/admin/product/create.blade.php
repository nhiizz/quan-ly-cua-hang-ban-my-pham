@extends('admin.layouts.master')

@section('content')

<h2>Thêm sản phẩm</h2>

<form action="{{ route('products.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label>Tên sản phẩm</label>

        <input
            type="text"
            name="ProductName"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Danh mục</label>

        <select
            name="CategoryID"
            class="form-control">

            @foreach($categories as $category)

                <option value="{{ $category->CategoryID }}">

                    {{ $category->CategoryName }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Thương hiệu</label>

        <select
            name="BrandID"
            class="form-control">

            @foreach($brands as $brand)

                <option value="{{ $brand->BrandID }}">

                    {{ $brand->BrandName }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Giá</label>

        <input
            type="number"
            name="Price"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Giá giảm</label>

        <input
            type="number"
            name="DiscountPrice"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Số lượng</label>

        <input
            type="number"
            name="Quantity"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Loại da</label>

        <input
            type="text"
            name="SkinType"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Khối lượng</label>

        <input
            type="text"
            name="Weight"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Thành phần</label>

        <textarea
            name="Ingredient"
            class="form-control"></textarea>

    </div>

    <div class="mb-3">

        <label>Hướng dẫn sử dụng</label>

        <textarea
            name="HowToUse"
            class="form-control"></textarea>

    </div>

    <div class="mb-3">

        <label>Mô tả</label>

        <textarea
            name="Description"
            class="form-control"></textarea>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select
            name="Status"
            class="form-control">

            <option value="1">Hoạt động</option>

            <option value="0">Ẩn</option>

        </select>

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

</form>

@endsection