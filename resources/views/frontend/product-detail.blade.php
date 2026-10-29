@extends('frontend.layouts.master')

@section('content')

<div class="row">

    <!-- Ảnh -->

    <div class="col-md-5">

        @if($product->images->count())

        <img src="{{ asset('images/'.$product->images->first()->ImageURL) }}"
             class="img-fluid rounded shadow">

        @else

        <img src="https://placehold.co/500x500"
             class="img-fluid rounded">

        @endif

        <div class="row mt-3">

            @foreach($product->images as $image)

            <div class="col-3">

                <img src="{{ asset('images/'.$image->ImageURL) }}"
                     class="img-thumbnail">

            </div>

            @endforeach

        </div>

    </div>

    <!-- Thông tin -->

    <div class="col-md-7">

        <h2>

            {{ $product->ProductName }}

        </h2>

        <h3 class="text-danger">

            {{ number_format($product->Price) }} đ

        </h3>

        <hr>

        <p>

            <strong>Danh mục:</strong>

            {{ $product->category->CategoryName }}

        </p>

        <p>

            <strong>Thương hiệu:</strong>

            {{ $product->brand->BrandName }}

        </p>

        <p>

            <strong>Loại da:</strong>

            {{ $product->SkinType }}

        </p>

        <p>

            <strong>Khối lượng:</strong>

            {{ $product->Weight }}

        </p>

        <p>

            <strong>Số lượng:</strong>

            {{ $product->Quantity }}

        </p>

        <hr>

        <h5>Mô tả</h5>

        <p>

            {{ $product->Description }}

        </p>

        <h5>Thành phần</h5>

        <p>

            {{ $product->Ingredient }}

        </p>

        <h5>Cách sử dụng</h5>

        <p>

            {{ $product->HowToUse }}

        </p>

        <form action="{{ route('cart.add',$product->ProductID) }}"
      method="POST">

    @csrf

    <button class="btn btn-primary w-100">

        Thêm vào giỏ

    </button>

</form>

    </div>

</div>

@endsection