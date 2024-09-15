<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'catalog_id',
        'quantity',
        'unit_price',
        'total_price',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }
}
