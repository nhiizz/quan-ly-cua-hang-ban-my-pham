<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StaffController extends Controller
{
    // Danh sách nhân viên
    public function index()
    {
        $staffs = Staff::all();

        return view('admin.staff.index', compact('staffs'));
    }

    // Form thêm
    public function create()
    {
        return view('admin.staff.create');
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

        'FullName.required' => 'Vui lòng nhập họ tên.',
        'Email.required'    => 'Vui lòng nhập email.',
        'Email.email'       => 'Email không đúng định dạng.',
        'Phone.required'    => 'Vui lòng nhập số điện thoại.',
        'Address.required'  => 'Vui lòng nhập địa chỉ.'
    ]);

    // Tạo tài khoản
    $account = Account::create([
        'UserName' => $request->UserName,
        'Password' => $request->Password, // Tạm thời, sau sẽ mã hóa bằng Hash::make()
        'Role'     => 'Staff',
        'Status'   => 1
    ]);

    // Tạo nhân viên
    Staff::create([
        'AccountID' => $account->AccountID,
        'FullName'  => $request->FullName,
        'Email'     => $request->Email,
        'Phone'     => $request->Phone,
        'Address'   => $request->Address
    ]);

    return Redirect::route('staffs.index')
        ->with('success', 'Thêm nhân viên thành công!');
}

    public function show(Staff $staff)
    {
        //
    }

    // Form sửa
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', compact('staff'));
    }

    // Cập nhật
    public function update(Request $request, Staff $staff)
    {
        $request->validate(
        [
            'FullName' => 'required|max:100',
            'Email'    => 'required|email',
            'Phone'    => 'required|max:20',
            'Address'  => 'required'
        ]);

        $staff->update($request->all());

        return Redirect::route('staffs.index')
            ->with('success', 'Cập nhật thành công!');
    }

    // Xóa
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return Redirect::route('staffs.index')
            ->with('success', 'Xóa thành công!');
    }
}
