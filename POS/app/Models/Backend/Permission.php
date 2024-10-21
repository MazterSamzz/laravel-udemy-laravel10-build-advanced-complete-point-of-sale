<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    // Accessor to encrypt the permission id when accessed
    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
