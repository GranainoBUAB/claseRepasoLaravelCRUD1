<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = [
        'product_id',
        'news',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
