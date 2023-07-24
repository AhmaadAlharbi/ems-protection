<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Takleef extends Model
{
    use HasFactory;
    protected $table = 'takleefs';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function employee()
    {
        //
        return $this->belongsTo(Employee::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
