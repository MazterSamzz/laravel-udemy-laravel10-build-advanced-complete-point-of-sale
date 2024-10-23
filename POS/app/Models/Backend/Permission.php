<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory;

    public function getEncryptedIdAttribute()
    {
        return Crypt::encryptString($this->attributes['id']);
    }


    /**
     * Get a collection of permissions grouped by their group name.
     *
     * @return \Illuminate\Support\Collection
     */

    public static function groups()
    {
        return Permission::select('group_name')->groupBy('group_name')->get();
    }

    /**
     * Return a collection of permissions grouped by their group name.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function byGroupName()
    {
        return Permission::select('id', 'name', 'group_name')->get()->groupBy('group_name');
    }
}
