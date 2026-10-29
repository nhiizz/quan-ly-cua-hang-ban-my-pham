@extends('admin.layouts.master')

@section('content')

<h2>Quản lý đánh giá</h2>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<table class="table table-bordered table-hover">

    <thead>
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Sản phẩm</th>
            <th>Số sao</th>
            <th>Nội dung</th>
            <th>Ngày đánh giá</th>
            <th>Chức năng</th>
        </tr>
    </thead>

    <tbody>

    @forelse($reviews as $index)

        <tr>

            <td>{{ $index + 1 }}</td>

            <td>
                {{ $review->customer->FullName ?? '' }}
            </td>

            <td>
                {{ $review->product->ProductName ?? '' }}
            </td>

            <td>
                {{ $review->Rating }} ⭐
            </td>

            <td>
                {{ Str::limit($review->Comment,40) }}
            </td>

            <td>
                {{ $review->CreatedDate }}
            </td>

            <td>

                <a href="{{ route('reviews.show',$review) }}"
                   class="btn btn-info btn-sm">
                    Chi tiết
                </a>

                <form action="{{ route('reviews.destroy',$review) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?')">

                        Xóa

                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="7" class="text-center">

                Chưa có đánh giá nào.

            </td>

        </tr>

    @endforelse

    </tbody>

</table>

@endsection