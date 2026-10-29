<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Payment;
class Order extends Model
{
    use HasFactory;

    protected $table = 'Orders';

    protected $primaryKey = 'OrderID';

    public $timestamps = false;

    protected $fillable = [
        'CustomerID',
        'VoucherID',
        'ReceiverName',
        'ReceiverPhone',
        'ShippingAddress',
        'ShippingFee',
        'TotalAmount',
        'OrderDate',
        'OrderStatus',
        'PaymentStatus',
        'Note'
    ];

    // Một đơn hàng thuộc về một khách hàng
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID', 'CustomerID');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'OrderID', 'OrderID');
    }
    public function payment()
    {
        return $this->hasOne(Payment::class,'OrderID','OrderID');

    }
}