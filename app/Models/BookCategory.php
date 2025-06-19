<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;
    protected $table = 'book_categories';
    protected $primaryKey  = 'id';
    protected $fillable = [
        'id',
        'category_name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}