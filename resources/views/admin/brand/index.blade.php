@extends('admin.layouts.master')

@section('content')

<h2>Quản lý thương hiệu</h2>

<a href="{{ route('brands.create') }}" class="btn btn-success mb-3">
    Thêm thương hiệu
</a>

<table class="table table-bordered">

    <thead>

    <tr>
        <th>ID</th>
        <th>Tên thương hiệu</th>
        <th>Quốc gia</th>
        <th>Logo</th>
        <th>Mô tả</th>
        <th>Trạng thái</th>
        <th width="180">Chức năng</th>
    </tr>

    </thead>

    <tbody>

    @foreach($brands as $index => $brand)

<tr>

    <td>{{ $index + 1 }}</td>

    <td>{{ $brand->BrandName }}</td>

    <td>{{ $brand->Country }}</td>

    <td>{{ $brand->Logo }}</td>

    <td>{{ $brand->Description }}</td>

    <td>
        @if($brand->Status == 1)
            <span class="text-success">Hoạt động</span>
        @else
            <span class="text-danger">Ẩn</span>
        @endif
    </td>

    <td>

        <a href="{{ route('brands.edit',$brand) }}"
           class="btn btn-warning btn-sm">
            Sửa
        </a>

        <form action="{{ route('brands.destroy',$brand) }}"
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