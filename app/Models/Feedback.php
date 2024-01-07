<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'status',
        'token',
        'customer_id',
        'user_id',
        'branch_id',
        'rating',
        'recommendation',
        'comments'

    ];

    public function branch(){
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

   
}
