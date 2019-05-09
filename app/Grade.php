<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'lecture_id',
        'student_id',
        'grade'
    ];

    public function lecture() {
        return $this->belongsTo('App\Lecture');
    }

    public function student() {
        return $this->belongsTo('App\Student');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
