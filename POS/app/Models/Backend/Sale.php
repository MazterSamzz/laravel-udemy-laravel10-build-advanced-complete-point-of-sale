<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'status',
        'total_products',
        'vat',
        'total',
        'payment_status',
        'paid',
        'recieveables',
    ];
}
