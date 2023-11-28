<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'civilId',
        'fileNo',
        'shift_group',
        'department_id'
    ];
    public function takleefList()
    {
        return $this->hasMany(Takleef::class);
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}