<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutboundTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'title',
        'description',
        'amount',
    ];
}
