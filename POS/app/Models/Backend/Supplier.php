<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'address',
        'shopname',
        'photo',
        'type',
        'account_holder',
        'account_number',
        'bank_name',
        'bank_branch',
        'city',
    ];
}
