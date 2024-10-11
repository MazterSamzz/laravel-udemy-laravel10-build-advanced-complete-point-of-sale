<?php

namespace App\Models\Backend;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Crypt;

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

    protected $casts = [
        'payment_status' => PaymentStatus::class, // Casting kolom payment_status ke enum
    ];

    // Accessor to encrypt the sale id when accessed
    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function salesDetail(): HasMany
    {
        return $this->hasMany(SalesDetail::class);
    }
}
