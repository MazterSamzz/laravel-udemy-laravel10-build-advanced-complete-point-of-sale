<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'address',
        'experience',
        'salary',
        'leave',
        'city',
    ];

    public function advance(): BelongsTo
    {
        return $this->belongsTo(AdvanceSalary::class, 'id', 'employee_id');
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class, 'employee_id', 'id');
    }
}
