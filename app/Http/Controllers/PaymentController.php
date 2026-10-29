<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    // Danh sách
    public function index()
    {
        $payments = Payment::with('order')->get();

        return view('admin.payment.index', compact('payments'));
    }

   
}