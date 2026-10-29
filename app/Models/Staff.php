<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'Staff';

    protected $primaryKey = 'StaffID';

    public $timestamps = false;

    protected $fillable = [
        'AccountID',
        'FullName',
        'Email',
        'Phone',
        'Address',
        'CreatedDate'
    ];
}