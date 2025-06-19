<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'class',
        'student_id',
        'major',
        'phone',
        'birthday',
        'username',
        'password'
    ];
}
