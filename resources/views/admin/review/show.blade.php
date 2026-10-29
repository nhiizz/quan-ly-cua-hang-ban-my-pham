@extends('admin.layouts.master')

@section('content')

<h2>Chi tiết đánh giá</h2>

<div class="card">

    <div class="card-body">

        <div class="mb-3">
            <strong>Khách hàng:</strong>
            {{ $review->customer->FullName ?? '' }}
        </div>

        <div class="mb-3">
            <strong>Sản phẩm:</strong>
            {{ $review->product->ProductName ?? '' }}
        </div>

        <div class="mb-3">
            <strong>Số sao:</strong>

            @for($i = 1; $i <= 5; $i++)

                @if($i <= $review->Rating)

                    ⭐

                @else

                    ☆

                @endif

            @endfor

            ({{ $review->Rating }}/5)

        </div>

        <div class="mb-3">
            <strong>Nội dung đánh giá:</strong>

            <div class="border rounded p-3 mt-2">

                {{ $review->Comment }}

            </div>

        </div>

        <div class="mb-3">
            <strong>Ngày đánh giá:</strong>

            {{ $review->CreatedDate }}

        </div>

    </div>

</div>

<div class="mt-3">

    <a href="{{ route('reviews.index') }}"
       class="btn btn-secondary">

        Quay lại

    </a>

    <form action="{{ route('reviews.destroy',$review) }}"
          method="POST"
          style="display:inline;">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger"
            onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?')">

            Xóa

        </button>

    </form>

</div>

@endsection