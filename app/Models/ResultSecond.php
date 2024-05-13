<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultSecond extends Model
{
    use HasFactory;

    protected $fillable = [
        'mat_num',
        'level_id',
        'semester',
        'academic_session_id',
        'cc1',
        'cu1',
        'score1',
        'grade1',
        'rmk1',
        'cc2',
        'cu2',
        'score2',
        'grade2',
        'rmk2',
        'cc3',
        'cu3',
        'score3',
        'grade3',
        'rmk3',
        'cc4',
        'cu4',
        'score4',
        'grade4',
        'rmk4',
        'cc5',
        'cu5',
        'score5',
        'grade5',
        'rmk5',
        'cc6',
        'cu6',
        'score6',
        'grade6',
        'rmk6',
        'cc7',
        'cu7',
        'score7',
        'grade7',
        'rmk7',
        'cc8',
        'cu8',
        'score8',
        'grade8',
        'rmk8',
        'cc9',
        'cu9',
        'score9',
        'grade9',
        'rmk9',
        'cc10',
        'cu10',
        'score10',
        'grade10',
        'rmk10',
        'cc11',
        'cu11',
        'score11',
        'grade11',
        'rmk11',
        'cc12',
        'cu12',
        'score12',
        'grade12',
        'rmk12',
        'department_id',
        'tgp',
        'tcu',
        'tce',
        'gpa',
        'pgpa',
        'pcgpa',
        'remarks',
    ];

    public function student(){
        return $this->belongsTo(Student::class, 'mat_num');
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
