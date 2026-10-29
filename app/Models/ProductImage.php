<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;


    protected $table = 'ProductImage';

    // Khóa chính
    protected $primaryKey = 'ImageID';

    // Không dùng created_at và updated_at
    public $timestamps = false;

    // Các cột được phép thêm/sửa
    protected $fillable = [
        'ProductID',
        'ImageURL',
        'IsMainImage'
    ];

    // Quan hệ với bảng Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
}