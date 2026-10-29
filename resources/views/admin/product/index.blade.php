@extends('admin.layouts.master')

@section('content')

<h2>Quản lý sản phẩm</h2>

<a href="{{ route('products.create') }}" class="btn btn-success mb-3">
    Thêm sản phẩm
</a>

<table class="table table-bordered table-hover">

    <thead>

    <tr>

        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Thương hiệu</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Trạng thái</th>
        <th width="180">Chức năng</th>

    </tr>

    </thead>

    <tbody>

    @foreach($products as $index => $product)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $product->ProductName }}</td>

        <td>{{ $product->category->CategoryName }}</td>

        <td>{{ $product->brand->BrandName }}</td>

        <td>{{ number_format($product->Price) }}</td>

        <td>{{ $product->Quantity }}</td>

        <td>
                 @if($product->Status == 1)
                    <span class="text-success">Hoạt động</span>
                 @else
                    <span class="text-danger">Ẩn</span>
                @endif
            </td>

        <td>

            <a href="{{ route('products.edit',$product) }}"
               class="btn btn-warning btn-sm">

                Sửa

            </a>

            <form
                action="{{ route('products.destroy',$product) }}"
                method="POST"
                style="display:inline">

                @csrf
                @method('DELETE')

                <button class="btn btn-danger btn-sm">

                    Xóa

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection