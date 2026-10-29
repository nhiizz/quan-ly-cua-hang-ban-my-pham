@extends('frontend.layouts.master')

@section('content')

<!-- Banner -->
<div class="p-5 mb-5 rounded text-center"
     style="background:linear-gradient(90deg,#8EC5FC,#B8E1FF);">

    <h1 class="text-white fw-bold">
        Cosmetic Store
    </h1>

    <p class="text-white">
        Mỹ phẩm chính hãng - Giá tốt mỗi ngày
    </p>

    <a href="{{ route('products.front') }}"
       class="btn btn-light mt-2">
        Mua ngay
    </a>

</div>

<!-- Tìm kiếm -->
<div class="row mb-5">

    <div class="col-md-10">
        <input type="text"
               class="form-control"
               placeholder="Tìm kiếm sản phẩm...">
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">
            Tìm kiếm
        </button>
    </div>

</div>

<!-- Danh mục -->
@foreach($categories as $category)

<h2 class="mb-4">
    {{ $category->CategoryName }}
</h2>

<div class="row">

    @foreach($category->products as $product)

    <div class="col-md-3 mb-4">

        <div class="card h-100 shadow-sm">

            @if($product->images->count())

<img src="{{ asset('images/'.$product->images->first()->ImageURL) }}"
     class="card-img-top"
     style="height:250px;object-fit:cover;">

@else

<img src="https://placehold.co/300x300"
     class="card-img-top"
     style="height:250px;object-fit:cover;">

@endif

            <div class="card-body">

                <h5>{{ $product->ProductName }}</h5>

                <p class="text-danger fw-bold">
                    {{ number_format($product->Price) }} đ
                </p>

                <a href="{{ route('product.detail',$product->ProductID) }}"
                   class="btn btn-outline-primary w-100">
                    Xem chi tiết
                </a>

                <form action="{{ route('cart.add',$product->ProductID) }}"
      method="POST">

    @csrf

    <button class="btn btn-primary w-100">

        Thêm vào giỏ

    </button>

</form>

            </div>

        </div>

    </div>

    @endforeach

</div>

<div class="text-end mb-5">

    <a href="{{ route('products.front',['category'=>$category->CategoryID]) }}"
       class="btn btn-primary">
        Xem tất cả >>
    </a>

</div>

<hr class="mb-5">

@endforeach

@endsection