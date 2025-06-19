<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'receipt_details';
    protected $primaryKey = [
        'receipt_id',
        'book_id'
    ];
    public $incrementing = false;
    protected $fillable = [
        'receipt_id',
        'book_id',
        'importPrice',
        'quantity',
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class, 'receipt_id')->withTrashed();
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id')->withTrashed();
    }

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if(!is_array($keys)){
            return parent::setKeysForSaveQuery($query);
        }

        foreach($keys as $keyName){
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if(is_null($keyName)){
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }
}
