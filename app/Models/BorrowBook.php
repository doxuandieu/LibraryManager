<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowBook extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'student_code',
        'student_name',
        'quantity',
        'beginDate',
        'endDate',
        'note',
        'status'
    ];

    public function details()
    {
        return $this->hasMany(BorrowBookDetail::class);
    }
}
