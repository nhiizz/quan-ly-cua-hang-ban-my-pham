<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'Review';

    protected $primaryKey = 'ReviewID';

    public $timestamps = false;

    protected $fillable = [
        'CustomerID',
        'ProductID',
        'Rating',
        'Comment',
        'CreatedDate'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'CustomerID','CustomerID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'ProductID','ProductID');
    }
}