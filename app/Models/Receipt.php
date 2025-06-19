<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'receipts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'date',
        'receiver',
    ];

    public function receiptDetails()
    {
        return $this->hasMany(ReceiptDetail::class, 'receipt_id', 'id');
    }
}
