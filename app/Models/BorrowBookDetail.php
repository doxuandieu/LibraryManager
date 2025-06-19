<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BorrowBookDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'borrow_book_id',
        'book_id',
        'quantity',
    ];

    public function borrow()
    {
        return $this->belongsTo(BorrowBook::class);
    }
    public function book()
    {
        return $this->belongsTo(Book::class)->withTrashed();
    }
}
