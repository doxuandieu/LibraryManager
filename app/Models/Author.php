<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Author extends Model
{
    use HasFactory;
    protected $table = 'authors';
    protected $primaryKey  = 'id';
    protected $fillable = [
        'id',
        'code',
        'name',
        'birthday'
    ];

    public function books()
    {
        return $this->hasMany(AuthorBook::class, 'author_id', 'id');
    }
}
