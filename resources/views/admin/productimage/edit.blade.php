@extends('admin.layouts.master')

@section('content')

<h2>Sửa hình ảnh sản phẩm</h2>

<form action="{{ route('productimages.update', $productimage) }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Sản phẩm</label>

        <select name="ProductID" class="form-control">

            @foreach($products as $product)

                <option value="{{ $product->ProductID }}"
                    {{ $productimage->ProductID == $product->ProductID ? 'selected' : '' }}>

                    {{ $product->ProductName }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Ảnh hiện tại</label><br>

        <img src="{{ asset('images/'.$productimage->ImageURL) }}"
             width="120"
             height="120"
             style="object-fit:cover;border-radius:8px;">

    </div>

    <div class="mb-3">

        <label>Chọn ảnh mới</label>

        <input type="file"
               name="ImageURL"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Ảnh đại diện</label>

        <select name="IsMainImage" class="form-control">

            <option value="1"
                {{ $productimage->IsMainImage == 1 ? 'selected' : '' }}>
                Có
            </option>

            <option value="0"
                {{ $productimage->IsMainImage == 0 ? 'selected' : '' }}>
                Không
            </option>

        </select>

    </div>

    <button type="submit" class="btn btn-primary">
        Cập nhật
    </button>

    <a href="{{ route('productimages.index') }}"
       class="btn btn-secondary">
        Quay lại
    </a>

</form>

@endsection