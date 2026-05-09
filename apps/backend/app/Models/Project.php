<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $table = 'projects'; //required to specify the table name if it doesn't follow Laravel's naming convention

    protected $fillable = [
        'code',
        'name',
        'date_started',
        'date_completion'
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'employee_projects', 'project_id', 'employee_id');
    }   
}
