@extends('admin.layouts.master')

@section('content')

<h2>Sửa sản phẩm</h2>

<form action="{{ route('products.update',$product) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Tên sản phẩm</label>

        <input
            type="text"
            name="ProductName"
            value="{{ $product->ProductName }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Danh mục</label>

        <select
            name="CategoryID"
            class="form-control">

            @foreach($categories as $category)

                <option
                    value="{{ $category->CategoryID }}"
                    {{ $product->CategoryID == $category->CategoryID ? 'selected' : '' }}>

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

                <option
                    value="{{ $brand->BrandID }}"
                    {{ $product->BrandID == $brand->BrandID ? 'selected' : '' }}>

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
            value="{{ $product->Price }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Giá giảm</label>

        <input
            type="number"
            name="DiscountPrice"
            value="{{ $product->DiscountPrice }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Số lượng</label>

        <input
            type="number"
            name="Quantity"
            value="{{ $product->Quantity }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Loại da</label>

        <input
            type="text"
            name="SkinType"
            value="{{ $product->SkinType }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Khối lượng</label>

        <input
            type="text"
            name="Weight"
            value="{{ $product->Weight }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Thành phần</label>

        <textarea
            name="Ingredient"
            class="form-control">{{ $product->Ingredient }}</textarea>

    </div>

    <div class="mb-3">

        <label>Hướng dẫn sử dụng</label>

        <textarea
            name="HowToUse"
            class="form-control">{{ $product->HowToUse }}</textarea>

    </div>

    <div class="mb-3">

        <label>Mô tả</label>

        <textarea
            name="Description"
class="form-control">{{ $product->Description }}</textarea>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select
            name="Status"
            class="form-control">

            <option value="1" {{ $product->Status == 1 ? 'selected' : '' }}>
                Hoạt động
            </option>

            <option value="0" {{ $product->Status == 0 ? 'selected' : '' }}>
                Ẩn
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

</form>

@endsection
