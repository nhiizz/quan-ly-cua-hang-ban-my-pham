<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index()
    {
        $orders = Order::with('customer')
        ->orderBy('OrderID','desc')
        ->get();

        return view('admin.order.index', compact('orders'));
        if(!session()->has('AdminID')){

        return redirect()->route('admin.login');

        }   
    }

    //  thêm đơn hàng
    public function create()
    {
        $customers = Customer::all();
        $vouchers = Voucher::all();

        return view('admin.order.create', compact('customers', 'vouchers'));
    }

    // lưu đơn hàng
    public function store(Request $request)
    {
        $request->validate([
            'CustomerID'      => 'required',
            'ReceiverName'    => 'required|max:100',
            'ReceiverPhone'   => 'required|max:20',
            'ShippingAddress' => 'required',
            'ShippingFee'     => 'required|numeric',
            'OrderStatus'     => 'required',
            'PaymentStatus'   => 'required'
        ]);

        $order = Order::create([
            'CustomerID'      => $request->CustomerID,
            'VoucherID'       => $request->VoucherID,
            'ReceiverName'    => $request->ReceiverName,
            'ReceiverPhone'   => $request->ReceiverPhone,
            'ShippingAddress' => $request->ShippingAddress,
            'ShippingFee'     => $request->ShippingFee,
            'TotalAmount'     => 0,
            'OrderDate'       => now(),
            'OrderStatus'     => $request->OrderStatus,
            'PaymentStatus'   => $request->PaymentStatus,
            'Note'            => $request->Note
        ]);
        Payment::create([
            'OrderID' => $order->OrderID,
            'Method' => 'COD',
            'PaymentDate' => now(),
            'Amount' => 0,
            'Status' => $request->PaymentStatus
        ]);

            // Chuyển sang trang Chi tiết đơn hàng
        return redirect()->route('orders.show', $order);
    }

    // Chi tiết đơn hàng
    public function show(Order $order)
    {
        $order->load('customer','orderDetails.product');

        return view('admin.order.show', compact('order'));
    }

    // Form sửa
    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    // Cập nhật
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'OrderStatus'   => 'required',
            'PaymentStatus' => 'required'
        ]);

        $order->update([
            'OrderStatus'   => $request->OrderStatus,
            'PaymentStatus' => $request->PaymentStatus
        ]);
        Payment::updateOrCreate([
            'OrderID'=> $order->OrderID
        ],
        [
            'Method' =>'COD',
            'PaymentDate'=>now(),
            'Amount'=> $order->TotalAmount,
            'Status'=> $request->PaymentStatus
        ]);

        return Redirect::route('orders.index')
            ->with('success', 'Cập nhật thành công!');
    }

    // Xóa

public function destroy(Order $order)
{
    Payment::where('OrderID', $order->OrderID)->delete();

    $order->delete();

    return Redirect::route('orders.index')
        ->with('success', 'Xóa thành công!');
}
}