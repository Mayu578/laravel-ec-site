<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // 注文したユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 注文明細
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
