<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderDetailController extends Controller
{
    // Danh sách (không dùng)
    public function index()
    {

    }

    // Form thêm sản phẩm vào đơn hàng
    public function create(Request $request)
    {
        $order = Order::findOrFail($request->order);

        $products = Product::all();

        return view(
            'admin.orderdetail.create',
            compact('order', 'products')
        );
    }

    // Lưu sản phẩm vào đơn hàng
    public function store(Request $request)
    {
        $request->validate(
        [
            'ProductID' => 'required',
            'Quantity'  => 'required|integer|min:1'
        ],
        [
            'ProductID.required' => 'Vui lòng chọn sản phẩm.',
            'Quantity.required'  => 'Vui lòng nhập số lượng.',
            'Quantity.min'       => 'Số lượng phải lớn hơn 0.'
        ]);

        $product = Product::findOrFail($request->ProductID);

        OrderDetail::create([
            'OrderID'   => $request->OrderID,
            'ProductID' => $request->ProductID,
            'Quantity'  => $request->Quantity,
            'UnitPrice' => $product->Price,
            'Subtotal'  => $product->Price * $request->Quantity
        ]);

        $order = Order::find($request->OrderID);

        $order->update([
            'TotalAmount' => OrderDetail::where(
                'OrderID',
                $request->OrderID
            )->sum('Subtotal')
        ]);

        return Redirect::route('orders.show', $request->OrderID)
            ->with('success', 'Thêm sản phẩm thành công!');
    }

    // Chi tiết (không dùng)
    public function show(OrderDetail $orderdetail)
    {

    }

    // Form sửa
    public function edit(OrderDetail $orderdetail)
    {
        return view(
            'admin.orderdetail.edit',
            compact('orderdetail')
        );
    }

    // Cập nhật
    public function update(Request $request, OrderDetail $orderdetail)
    {
        $request->validate(
        [
            'Quantity' => 'required|integer|min:1'
        ],
        [
            'Quantity.required' => 'Vui lòng nhập số lượng.',
            'Quantity.min'      => 'Số lượng phải lớn hơn 0.'
        ]);

        $subtotal = $request->Quantity * $orderdetail->UnitPrice;

        $orderdetail->update([
            'Quantity' => $request->Quantity,
            'Subtotal' => $subtotal
        ]);

        $order = Order::find($orderdetail->OrderID);

        $order->update([
            'TotalAmount' => OrderDetail::where(
                'OrderID',
                $orderdetail->OrderID
            )->sum('Subtotal')
        ]);

        return Redirect::route('orders.show', $orderdetail->OrderID)
->with('success', 'Cập nhật thành công!');
    }

    // Xóa
    public function destroy(OrderDetail $orderdetail)
    {
        $orderID = $orderdetail->OrderID;

        $orderdetail->delete();

        $order = Order::find($orderID);

        $order->update([
            'TotalAmount' => OrderDetail::where(
                'OrderID',
                $orderID
            )->sum('Subtotal')
        ]);

        return Redirect::route('orders.show', $orderID)
            ->with('success', 'Xóa sản phẩm thành công!');
    }
}
