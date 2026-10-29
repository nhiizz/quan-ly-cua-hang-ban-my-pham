<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VoucherController extends Controller
{
    // Hiển thị danh sách
    public function index()
    {
        $vouchers = Voucher::all();

        return view('admin.voucher.index', compact('vouchers'));
    }

    // Hiển thị form thêm
    public function create()
    {
        return view('admin.voucher.create');
    }

    // Lưu dữ liệu
    public function store(Request $request)
    {
        $request->validate(
        [
            'VoucherCode'   => 'required|max:50',
            'DiscountType'  => 'required',
            'DiscountValue' => 'required|numeric|min:1',
            'StartDate'     => 'required|date|after_or_equal:today',
            'EndDate'       => 'required|date|after_or_equal:StartDate',
            'Quantity'      => 'required|integer|min:1',
            'Status'        => 'required'
        ],
        [
            'VoucherCode.required' => 'Vui lòng nhập mã voucher.',
            'DiscountType.required' => 'Vui lòng chọn loại giảm giá.',
            'DiscountValue.required' => 'Vui lòng nhập giá trị giảm.',
            'DiscountValue.numeric' => 'Giá trị giảm phải là số.',
            'DiscountValue.min' => 'Giá trị giảm phải lớn hơn 0.',

            'StartDate.required' => 'Vui lòng chọn ngày bắt đầu.',
            'StartDate.after_or_equal' => 'Ngày bắt đầu không được nhỏ hơn ngày hiện tại.',

            'EndDate.required' => 'Vui lòng chọn ngày kết thúc.',
            'EndDate.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',

            'Quantity.required' => 'Vui lòng nhập số lượng.',
            'Quantity.integer' => 'Số lượng phải là số nguyên.',
            'Quantity.min' => 'Số lượng phải lớn hơn 0.',

            'Status.required' => 'Vui lòng chọn trạng thái.'
        ]);

        Voucher::create($request->all());

        return Redirect::route('vouchers.index')
            ->with('success', 'Thêm voucher thành công!');
    }

    // Không sử dụng
    public function show(Voucher $voucher)
    {
        //
    }

    // Hiển thị form sửa
    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    // Cập nhật
    public function update(Request $request, Voucher $voucher)
    {
        $request->validate(
        [
            'VoucherCode'   => 'required|max:50',
            'DiscountType'  => 'required',
            'DiscountValue' => 'required|numeric|min:1',
            'StartDate'     => 'required|date',
            'EndDate'       => 'required|date|after_or_equal:StartDate',
            'Quantity'      => 'required|integer|min:1',
            'Status'        => 'required'
        ],
        ['VoucherCode.required' => 'Vui lòng nhập mã voucher.',
            'DiscountType.required' => 'Vui lòng chọn loại giảm giá.',
            'DiscountValue.required' => 'Vui lòng nhập giá trị giảm.',
            'DiscountValue.numeric' => 'Giá trị giảm phải là số.',
            'DiscountValue.min' => 'Giá trị giảm phải lớn hơn 0.',

            'StartDate.required' => 'Vui lòng chọn ngày bắt đầu.',
            'EndDate.required' => 'Vui lòng chọn ngày kết thúc.',
            'EndDate.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',

            'Quantity.required' => 'Vui lòng nhập số lượng.',
            'Quantity.integer' => 'Số lượng phải là số nguyên.',
            'Quantity.min' => 'Số lượng phải lớn hơn 0.',

            'Status.required' => 'Vui lòng chọn trạng thái.'
        ]);

        $voucher->update($request->all());

        return Redirect::route('vouchers.index')
            ->with('success', 'Cập nhật voucher thành công!');
    }

    // Xóa
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return Redirect::route('vouchers.index')
            ->with('success', 'Xóa voucher thành công!');
    }
}