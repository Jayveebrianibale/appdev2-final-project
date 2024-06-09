<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'chair_id', 'quantity', 'price', 'total'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function chair()
    {
        return $this->belongsTo(Chair::class);
    }
}
