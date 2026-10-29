<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    // Danh sách tài khoản
    public function index()
    {
        $accounts = Account::all();

        return view('admin.account.index', compact('accounts'));
    }

    // Form thêm
    public function create()
    {
        return view('admin.account.create');
    }

    // Lưu
    public function store(Request $request)
    {
        $request->validate(
        [
            'UserName' => 'required|max:50|unique:Account,UserName',
            'Password' => 'required|min:6',
            'Role'     => 'required|in:Admin',
            'Status'   => 'required'
        ],
        [
            'UserName.required' => 'Vui lòng nhập tên đăng nhập.',
            'UserName.unique'   => 'Tên đăng nhập đã tồn tại.',
            'Password.required' => 'Vui lòng nhập mật khẩu.',
            'Password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'Role.required'     => 'Vui lòng chọn quyền.',
            'Status.required'   => 'Vui lòng chọn trạng thái.'
        ]);

        Account::create([
            'UserName' => $request->UserName,
            'Password' => $request->Password,
            'Role'     => 'Admin',
            'Status'   => $request->Status
        ]);

        return Redirect::route('accounts.index')
            ->with('success', 'Thêm tài khoản thành công!');
    }

    public function show(Account $account)
    {

    }

    // Form sửa
    public function edit(Account $account)
    {
        return view('admin.account.edit', compact('account'));
    }

    // Cập nhật
    public function update(Request $request, Account $account)
    {
        $request->validate(
        [
            'UserName' => 'required|max:50|unique:Account,UserName,' . $account->AccountID . ',AccountID',
            'Password' => 'required|min:6',
            'Status'   => 'required'
        ]);

        $account->update([
            'UserName' => $request->UserName,
            'Password' => $request->Password,
            'Status'   => $request->Status
        ]);

        return Redirect::route('accounts.index')
            ->with('success', 'Cập nhật thành công!');
    }

    // Xóa
   public function destroy(Account $account)
{
    Customer::where('AccountID', $account->AccountID)->delete();

    Staff::where('AccountID', $account->AccountID)->delete();

    $account->delete();

    return redirect()->route('accounts.index')
        ->with('success','Xóa thành công');
}
}
