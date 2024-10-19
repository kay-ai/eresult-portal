<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpa extends Model
{
    use HasFactory;

    protected $fillable = [
        'mat_num',
        'gpa',
        'level_id',
        'department_id',
        'semester',
        'academic_session',
        'tcu'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
