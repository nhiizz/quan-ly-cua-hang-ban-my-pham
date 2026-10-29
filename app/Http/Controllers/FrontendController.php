<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class FrontendController extends Controller
{
    // Trang chủa
public function home()
{
    $categories = Category::with([
        'products.images'
    ])->get();

    return view('frontend.home', compact('categories'));
}


    // Danh sách sản phẩm
public function products(Request $request)
{
    $categories = Category::all();

    $query = Product::with('images', 'category');

    // Lọc theo danh mục
    if ($request->category) {
        $query->where('CategoryID', $request->category);
    }

    // Tìm kiếm
    if ($request->keyword) {
        $query->where('ProductName', 'like', '%' . $request->keyword . '%');
    }

    $products = $query->paginate(8);

    return view('frontend.products', compact(
        'products',
        'categories'
    ));
}

    // Chi tiết sản phẩm
    public function productDetail($id)
{
   $product = Product::with([
    'category',
    'brand',
    'reviews',
    'images'
])->findOrFail($id);
    return view('frontend.product-detail', compact('product'));
}

    // Giỏ hàng
   public function cart()
{
    $cart = session()->get('cart', []);

    return view('frontend.cart', compact('cart'));
}

    // Thanh toán
   public function checkout()
{
    $cart = session()->get('cart', []);

    if(empty($cart)){
        return redirect()->route('cart');
    }

    return view('frontend.checkout', compact('cart'));
}
public function checkoutStore(Request $request)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart');
    }

    $customer = Customer::where('AccountID', session('AccountID'))->first();

    if (!$customer) {
        return redirect()->route('login');
    }

    $total = 0;

foreach ($cart as $item) {
    $total += $item['Price'] * $item['quantity'];
}

    $order = Order::create([
        'CustomerID' => $customer->CustomerID,
        'VoucherID' => null,
        'ReceiverName' => $customer->FullName,
        'ReceiverPhone' => $customer->Phone,
        'ShippingAddress' => $customer->Address,
        'ShippingFee' => 0,
        'TotalAmount' => $total,
        'OrderDate' => now(),
        'OrderStatus' => 'Chờ xác nhận',
        'PaymentStatus' => 'Chưa thanh toán',
        'Note' => null
    ]);

    foreach ($cart as $item) {

    OrderDetail::create([
        'OrderID'   => $order->OrderID,
        'ProductID' => $item['ProductID'],
        'Quantity'  => $item['quantity'],
        'UnitPrice' => $item['Price'],
        'Subtotal'  => $item['Price'] * $item['quantity']
    ]);
}

    Payment::create([
        'OrderID' => $order->OrderID,
        'Method' => 'COD',
        'TransactionCode' => null,
        'PaymentDate' => now(),
        'Amount' => $total,
        'Status' => 'Chưa thanh toán'
    ]);

    session()->forget('cart');

    return redirect()->route('home')
            ->with('success','Đặt hàng thành công!');
}


    // Đăng nhập
    public function login()
    {
        return view('frontend.login');
    }

    // Đăng ký
    public function register()
    {
        return view('frontend.register');
    }
public function registerStore(Request $request)
{
   $request->validate(
[
    'FullName' => 'required|max:100',
    'UserName' => 'required|unique:Account,UserName',
    'Password' => 'required|min:6|confirmed',
    'Email'    => 'required|email',
    'Phone'    => 'required',
    'Address'  => 'required'
],
[
    'FullName.required' => 'Vui lòng nhập họ và tên.',
    'UserName.required' => 'Vui lòng nhập tên đăng nhập.',
    'UserName.unique'   => 'Tên đăng nhập đã tồn tại.',
    'Email.required'    => 'Vui lòng nhập email.',
    'Email.email'       => 'Email không đúng định dạng.',
    'Phone.required'    => 'Vui lòng nhập số điện thoại.',
    'Address.required'  => 'Vui lòng nhập địa chỉ.',
    'Password.required' => 'Vui lòng nhập mật khẩu.',
    'Password.min'      => 'Mật khẩu phải có ít nhất 6 ký tự.',
    'Password.confirmed'=> 'Mật khẩu xác nhận không khớp.'
]);

    $account = Account::create([
        'UserName' => $request->UserName,
        'Password' => Hash::make($request->Password),
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

    return redirect()->route('home')
        ->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
}

    // Đơn hàng
    public function orders()
{
    if (!session()->has('AccountID')) {
        return redirect()->route('login');
    }

    $customer = Customer::where('AccountID', session('AccountID'))->first();

    if (!$customer) {
        return redirect()->route('home')
            ->with('error', 'Không tìm thấy thông tin khách hàng.');
    }

    $orders = Order::where('CustomerID', $customer->CustomerID)
                    ->orderByDesc('OrderID')
                    ->get();

    return view('frontend.orders', compact('orders'));
}
    public function logout()
    {
        session()->flush();
        return redirect()->route('home');
    }
    public function loginCheck(Request $request)
{
    $account = Account::where('UserName', $request->UserName)->first();

    if (!$account) {

        return back()->with('error', 'Tên đăng nhập không tồn tại.');

    }

    if (!Hash::check($request->Password, $account->Password)) {

        return back()->with('error', 'Mật khẩu không đúng.');

    }
    // Kiểm tra tài khoản khách hàng đã có thông tin Customer chưa
if ($account->Role == 'Customer') {

    $customer = Customer::where('AccountID', $account->AccountID)->first();

    if (!$customer) {

        return back()->with(
            'error',
            'Tài khoản chưa được khởi tạo đầy đủ. Vui lòng đăng ký lại hoặc liên hệ quản trị viên.'
        );

    }
}

    session([
        'AccountID' => $account->AccountID,
        'UserName'  => $account->UserName,
        'Role'      => $account->Role
    ]);

    return redirect()->route('home')
            ->with('success', 'Đăng nhập thành công!');
}
public function addToCart($id)
{
    $product = Product::findOrFail($id);

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        if ($cart[$id]['quantity'] < $cart[$id]['QuantityStock']) {
         $cart[$id]['quantity']++;
        }
    }else {

        $cart[$id] = [

            'ProductID' => $product->ProductID,

            'ProductName' => $product->ProductName,

            'Price' => $product->Price,

            'QuantityStock' => $product->Quantity,

            'quantity' => 1,

            'Image' => optional($product->images()->where('IsMainImage',1)->first())->ImageURL

        ];

    }

    session()->put('cart', $cart);

    return back()->with('success','Đã thêm vào giỏ hàng!');
}
public function removeCart($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])){
        unset($cart[$id]);
    }

    session()->put('cart',$cart);

    return back()->with('success','Đã xóa sản phẩm.');
}
public function increaseCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        if ($cart[$id]['quantity'] < $cart[$id]['QuantityStock']) {

            $cart[$id]['quantity']++;

        }

    }

    session()->put('cart', $cart);

    return back();
}

public function decreaseCart($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        $cart[$id]['quantity']--;

        if ($cart[$id]['quantity'] <= 0) {

            unset($cart[$id]);

        }

    }

    session()->put('cart', $cart);

    return back();
}
public function myOrders()
{
    if (!session()->has('AccountID')) {
        return redirect()->route('login');
    }

    $customer = Customer::where('AccountID', session('AccountID'))->first();

    $orders = Order::where('CustomerID', $customer->CustomerID)
                    ->orderBy('OrderDate', 'desc')
                    ->get();

    return view('frontend.my-orders', compact('orders'));
}
public function myOrderDetail($id)
{
    if (!session()->has('AccountID')) {
        return redirect()->route('login');
    }

    $customer = Customer::where('AccountID', session('AccountID'))->first();

    $order = Order::with('orderDetails.product')
                ->where('CustomerID', $customer->CustomerID)
                ->findOrFail($id);

    return view('frontend.my-order-detail', compact('order'));
}
public function adminLogin()
{
    return view('admin.login');
}

public function adminLoginCheck(Request $request)
{
    $account = Account::where('UserName', $request->UserName)
                ->where('Role', 'Admin')
                ->first();

    if (!$account) {

        return back()->with('error','Tài khoản Admin không tồn tại.');

    }

    if (!Hash::check($request->Password, $account->Password)) {

        return back()->with('error','Mật khẩu không đúng.');

    }

    session([
        'AdminID'   => $account->AccountID,
        'AdminName' => $account->UserName
    ]);

    return redirect()->route('admin.dashboard');
}

public function adminLogout()
{
    session()->forget([
        'AdminID',
        'AdminName'
    ]);

    return redirect()->route('admin.login');
}
}