<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'supplier_id',
        'code',
        'garage',
        'image',
        'store',
        'buying_date',
        'expire_date',
        'buying_price',
        'selling_price',

    ];
}
