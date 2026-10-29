<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'OrderDetail';

    protected $primaryKey = 'OrderDetailID';

    public $timestamps = false;

    protected $fillable = [
        'OrderID',
        'ProductID',
        'Quantity',
        'UnitPrice',
        'Subtotal'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'OrderID','OrderID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
}