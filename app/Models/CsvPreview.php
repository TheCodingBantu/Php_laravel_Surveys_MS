<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvPreview extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'dob',
        'gender',

    ];

    protected $casts = [
        'dob' => 'date:d/m/Y',
    ];

}
