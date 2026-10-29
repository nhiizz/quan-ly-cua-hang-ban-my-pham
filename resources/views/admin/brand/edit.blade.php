@extends('admin.layouts.master')

@section('content')

<h2>Sửa thương hiệu</h2>

<form action="{{ route('brands.update',$brand) }}" method="POST">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label>Tên thương hiệu</label>

        <input type="text"
               name="BrandName"
               value="{{ $brand->BrandName }}"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Quốc gia</label>

        <input type="text"
               name="Country"
               value="{{ $brand->Country }}"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Logo</label>

        <input type="text"
               name="Logo"
               value="{{ $brand->Logo }}"
               class="form-control">

    </div>

    <div class="mb-3">

        <label>Mô tả</label>

        <textarea
            name="Description"
            class="form-control">{{ $brand->Description }}</textarea>

    </div>

    <div class="mb-3">

        <label>Trạng thái</label>

        <select name="Status" class="form-control">

            <option value="1" {{ $brand->Status == 1 ? 'selected' : '' }}>
                Hoạt động
            </option>

            <option value="0" {{ $brand->Status == 0 ? 'selected' : '' }}>
                Ẩn
            </option>

        </select>

    </div>

    <button class="btn btn-primary">

        Cập nhật

    </button>

</form>

@endsection