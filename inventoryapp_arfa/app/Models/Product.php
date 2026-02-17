<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // app/Models/Product.php
protected $fillable = [
    'name',
    'category_id',
    'price',
    'stock',
    'image',
    'description',  // ← tambahkan ini
];

protected $casts = [
    'price' => 'decimal:2',  // biar otomatis jadi float/desimal saat diambil
    'stock' => 'integer',
];

public function category()
{
    return $this->belongsTo(Category::class);
}

public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function getStockAttribute()
{
    $in = $this->transactions()->where('type','in')->sum('amount');
    $out = $this->transactions()->where('type','out')->sum('amount');

    return $in - $out;
}



}
