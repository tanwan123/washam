<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'pickup_address',
        'delivery_address',
        'contact_phone',
        'total',
        'status',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
       public function collector()
    {
        return $this->belongsTo(User::class, 'collector_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    
}

