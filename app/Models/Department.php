<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function secondSemesterResults()
    {
        return $this->hasMany(SecondSemesterResult::class);
    }

    public function examOfficer()
    {
        return $this->hasMany(ExamOfficer::class);
    }
}
