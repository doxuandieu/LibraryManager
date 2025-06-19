<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dissertation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'year',
        'semester',
        'student_id',
        'class_id',
        'student_name',
        'gender',
        'yearOfBirth',
        'major',
        'titleInVietnamese',
        'titleInEnglish',
        'lecturer_name',
        'status',
    ];

    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        return new User([
            'year'                  => $row[0],
            'semester'              => $row[1],
            'student_id',
            'class_id',
            'student_name',
            'gender',
            'yearOfBirth',
            'major',
            'titleInVietnamese',
            'titleInEnglish',
            'lecturer_name',
            'status',
        ]);
    }
}
