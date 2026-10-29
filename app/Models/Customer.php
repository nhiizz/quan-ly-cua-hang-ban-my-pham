<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Account;

class Customer extends Model
{
    protected $table = 'Customer';

    protected $primaryKey = 'CustomerID';

    public $timestamps = false;

    protected $fillable = [
        'AccountID',
        'FullName',
        'Email',
        'Phone',
        'Address',
        'Avatar',
        'CreatedDate'
    ];

    // Một khách hàng có một tài khoản
    public function account()
    {
        return $this->belongsTo(Account::class, 'AccountID', 'AccountID');
    }

    // Một khách hàng có nhiều đơn hàng
    public function orders()
    {
        return $this->hasMany(Order::class, 'CustomerID', 'CustomerID');
    }
    public function review(){
        return $this->hasMany(Review::class,'CustomerID','CustomerID');
    }
    
}