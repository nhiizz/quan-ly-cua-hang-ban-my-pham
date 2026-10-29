@extends('frontend.layouts.master')

@section('content')

<h2 class="mb-4">
    Tất cả sản phẩm
</h2>

<form method="GET"
      action="{{ route('products.front') }}"
      class="row mb-4">

<div class="col-md-4">

<select
name="category"
class="form-select"
onchange="this.form.submit()">

<option value="">
Tất cả danh mục
</option>

@foreach($categories as $category)

<option
value="{{ $category->CategoryID }}"
{{ request('category')==$category->CategoryID ? 'selected':'' }}>

{{ $category->CategoryName }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6">

<input
type="text"
name="keyword"
value="{{ request('keyword') }}"
class="form-control"
placeholder="Tìm sản phẩm...">

</div>

<div class="col-md-2">

<button class="btn btn-primary w-100">

Tìm

</button>

</div>

</form>

<div class="row">

@foreach($products as $product)

<div class="col-md-3 mb-4">

<div class="card h-100 shadow">

@if($product->images->count())

<img
src="{{ asset('images/'.$product->images->first()->ImageURL) }}"
class="card-img-top"
style="height:250px;object-fit:cover;">

@else

<img
src="https://placehold.co/300x300"
class="card-img-top">

@endif

<div class="card-body">

<h6>

{{ $product->ProductName }}

</h6>

<p class="text-danger fw-bold">

{{ number_format($product->Price) }} đ

</p>

<a
href="{{ route('product.detail',$product->ProductID) }}"
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

<div class="mt-4">

{{ $products->withQueryString()->links() }}

</div>

@endsection