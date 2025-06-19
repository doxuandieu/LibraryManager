<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';

    protected $primaryKey  = 'id';

    protected $fillable = [
        'id',
        'book_code',
        'book_name',
        'publish_year',
        'total_pages',
        'price',
        'stock',
        'address',
        'book_type',
        'category_id',
        'publisher_id',
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function authors()
    {
        return $this->hasMany(AuthorBook::class, 'book_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
