<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Account;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    // Danh sách khách hàng
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customer.index', compact('customers'));
    }

    // Form thêm
    public function create()
    {
        return view('admin.customer.create');
    }

    // Lưu
   public function store(Request $request)
{
    $request->validate(
    [
        'UserName' => 'required|max:50|unique:Account,UserName',
        'Password' => 'required|min:6',

        'FullName' => 'required|max:100',
        'Email'    => 'required|email',
        'Phone'    => 'required|max:20',
        'Address'  => 'required'
    ],
    [
        'UserName.required' => 'Vui lòng nhập tên đăng nhập.',
        'UserName.unique'   => 'Tên đăng nhập đã tồn tại.',
        'Password.required' => 'Vui lòng nhập mật khẩu.',
        'Password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',

        'FullName.required' => 'Vui lòng nhập họ và tên.',
        'Email.required'    => 'Vui lòng nhập email.',
        'Email.email'       => 'Email không đúng định dạng.',
        'Phone.required'    => 'Vui lòng nhập số điện thoại.',
        'Address.required'  => 'Vui lòng nhập địa chỉ.'
    ]);

    $account = Account::create([
        'UserName' => $request->UserName,
        'Password' => $request->Password,
        'Role'     => 'Customer',
        'Status'   => 1
    ]);

    Customer::create([
        'AccountID' => $account->AccountID,
        'FullName'  => $request->FullName,
        'Email'     => $request->Email,
        'Phone'     => $request->Phone,
        'Address'   => $request->Address
    ]);

    return Redirect::route('customers.index')
        ->with('success','Thêm khách hàng thành công!');
}

    public function show(Customer $customer)
    {

    }

    // Form sửa
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', compact('customer'));
    }

    // Cập nhật
    public function update(Request $request, Customer $customer)
    {
        $request->validate(
        [
            'FullName' => 'required|max:100',
            'Email'    => 'required|email',
            'Phone'    => 'required|max:20',
            'Address'  => 'required'
        ]);

        $customer->update($request->all());

        return Redirect::route('customers.index')
            ->with('success','Cập nhật thành công!');
    }

    // Xóa
    public function destroy(Customer $customer)
{
    if (Order::where('CustomerID', $customer->CustomerID)->exists()) {

        return redirect()->route('customers.index')
            ->with('error', 'Khách hàng đã có đơn hàng nên không thể xóa!');
    }

    $customer->delete();

    return redirect()->route('customers.index')
        ->with('success', 'Xóa thành công!');
}
}