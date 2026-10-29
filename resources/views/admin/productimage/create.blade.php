@extends('admin.layouts.master')

@section('content')

<h2>Thêm hình ảnh sản phẩm</h2>

<form action="{{ route('productimages.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="mb-3">

        <label>Sản phẩm</label>

        <select name="ProductID" class="form-control">

            @foreach($products as $product)

                <option value="{{ $product->ProductID }}">
                    {{ $product->ProductName }}
                </option>

            @endforeach

        </select>

    </div>

    <div class="mb-3">

        <label>Ảnh</label>

        <input
            type="file"
            name="ImageURL"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Ảnh đại diện</label>

        <select
            name="IsMainImage"
            class="form-control">

            <option value="1">Có</option>
            <option value="0">Không</option>

        </select>

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

</form>

@endsection