@extends('admin.layouts.master')

@section('content')

<h2>Thêm danh mục</h2>

<form action="{{ route('categories.store') }}" method="POST">

    @csrf

    <div class="mb-3">

        <label>Tên danh mục</label>

        <input type="text"
            name="CategoryName"
            class="form-control">

    </div>

    <div class="mb-3">

        <label>Mô tả</label>

        <textarea
            name="Description"
            class="form-control"></textarea>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select
            name="Status"
            class="form-control">

            <option value="1">Hoạt động</option>

            <option value="0">Ẩn</option>

        </select>

    </div>

    <button class="btn btn-success">

        Lưu

    </button>

</form>

@endsection