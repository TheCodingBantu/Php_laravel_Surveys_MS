<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $model = Customer::class;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'dob',
        'gender',
        'user_id',
    ];
    protected $casts = [
        'dob' => 'date:d/m/Y',
    ];

}
