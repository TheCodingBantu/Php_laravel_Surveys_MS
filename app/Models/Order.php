<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // create relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function  branch(){
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function  cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
