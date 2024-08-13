<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'shopname',
        'image',
        'account_holder',
        'account_number',
        'bank_name',
        'bank_branch',
        'city',
    ];
}
