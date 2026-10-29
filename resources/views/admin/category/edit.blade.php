@extends('admin.layouts.master')

@section('content')

<h2>Sửa danh mục</h2>

<form action="{{ route('categories.update',$category) }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Tên danh mục</label>

        <input type="text"
            name="CategoryName"
            value="{{ $category->CategoryName }}"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Mô tả</label>

        <textarea
            name="Description"
            class="form-control">{{ $category->Description }}</textarea>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select
            name="Status"
            class="form-control">

            <option value="1" {{ $category->Status == 1 ? 'selected' : '' }}>
                Hoạt động
            </option>

            <option value="0" {{ $category->Status == 0 ? 'selected' : '' }}>
                Ẩn
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

</form>

@endsection
