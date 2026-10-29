<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'Account';

    protected $primaryKey = 'AccountID';

    public $timestamps = false;

    protected $fillable = [
        'UserName',
        'Password',
        'Role',
        'Status',
        'CreatedDate'
    ];
    public function customer(){
        return $this->hasOne(Customer::class,'AccountID','AccountID');
    }
}