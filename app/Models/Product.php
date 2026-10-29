<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Product';

    protected $primaryKey = 'ProductID';

    public $timestamps = false;

    protected $fillable = [
        'CategoryID',
        'BrandID',
        'ProductName',
        'Price',
        'DiscountPrice',
        'Quantity',
        'Description',
        'Ingredient',
        'HowToUse',
        'SkinType',
        'Weight',
        'Status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'BrandID', 'BrandID');
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'ProductID','ProductID');
    }
       public function reviews()
    {
        return $this->hasMany(Review::class,'ProductID','ProductID');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class,'ProductID','ProductID');
    }
}