<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    protected $table = 'departments'; //required to specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'code',
        'name',
        'description'
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
