@extends('admin.layouts.master')

@section('content')

<h2>Quản lý hình ảnh sản phẩm</h2>

<a href="{{ route('productimages.create') }}" class="btn btn-success mb-3">
    Thêm hình ảnh
</a>

<table class="table table-bordered table-hover">

    <thead>

    <tr>
        <th>ID</th>
        <th>Sản phẩm</th>
        <th>Hình ảnh</th>
        <th>Ảnh đại diện</th>
        <th>Chức năng</th>
    </tr>

    </thead>

    <tbody>

    @foreach($images as $index => $image)

    <tr>

        <td>{{ $index + 1 }}</td>

        <td>{{ $image->product->ProductName }}</td>

        <td>
            <img src="{{ asset('images/'.$image->ImageURL) }}"
                 width="100"
                 height="100"
                 style="object-fit:cover;border-radius:8px;">
        </td>

        <td>
            {{ $image->IsMainImage ? 'Có' : 'Không' }}
        </td>

        <td>

            <a href="{{ route('productimages.edit',$image) }}"
               class="btn btn-warning btn-sm">
                Sửa
            </a>

            <form action="{{ route('productimages.destroy',$image) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-danger btn-sm">
                    Xóa
                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

@endsection