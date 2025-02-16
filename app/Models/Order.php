<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'mechanic_id', 'status', 'total_amount'];



    public function User()
    {
        return $this->belongsTo(User::class, 'OwnerID');
    }

    public function Mechanic()
    {
        return $this->belongsTo(Mechanic::class, 'ShopID');
    }

    public function shopInventory()
    {
        return $this->belongsTo(ShopInventory::class, 'PID');
    }

    public function items() 
    {
        return $this->hasMany(OrderItem::class);
    }
}
