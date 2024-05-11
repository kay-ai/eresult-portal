<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'mat_num',
        'level_id',
        'academic_session_id',
        'semester',
        'tce',
        'tcu',
        'tgp',
        'gpa',
        'remarks',
    ];
}
