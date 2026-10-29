@extends('admin.layouts.master')

@section('content')

<h2>Quản lý danh mục</h2>

<a href="{{ route('categories.create') }}" class="btn btn-success mb-3">
    Thêm danh mục
</a>

<table class="table table-bordered">

    <thead>

        <tr>
            <th>ID</th>
            <th>Tên danh mục</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th width="180">Chức năng</th>
        </tr>

    </thead>

    <tbody>

        @foreach($categories as $index =>$category)

        <tr>

            <td>{{ $index + 1}}</td>

            <td>{{ $category->CategoryName }}</td>

            <td>{{ $category->Description }}</td>

<td>
                 @if($category->Status == 1)
                    <span class="text-success">Hoạt động</span>
                 @else
                    <span class="text-danger">Ẩn</span>
                @endif
            </td>

            <td>

                <a href="{{ route('categories.edit',$category) }}"
                    class="btn btn-warning btn-sm">

                    Sửa

                </a>

                <form action="{{ route('categories.destroy',$category) }}"
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