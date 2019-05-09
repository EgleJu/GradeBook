<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    //

    protected $fillable = [
        'name',
        'desription',
    ];

    public function grade() {
        return $this->hasMany(Grade::class);
    }

    public function hasOneGrade() {
        return $this->hasOne(Grade::class)->latest();
    }
}
