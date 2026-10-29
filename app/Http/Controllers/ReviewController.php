<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends Controller
{
    // Danh sách đánh giá
    public function index()
    {
        $reviews = Review::with(['customer', 'product'])->get();

        return view('admin.review.index', compact('reviews'));
    }

    // Xem chi tiết
    public function show(Review $review)
    {
        return view('admin.review.show', compact('review'));
    }

    // Xóa đánh giá
    public function destroy(Review $review)
    {
        $review->delete();

        return Redirect::route('reviews.index')
            ->with('success', 'Xóa đánh giá thành công!');
    }
}