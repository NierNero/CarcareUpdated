<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = ['user_id', 'mechanic_id','prdouct_id', 'status', 'total_amount'];



    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }

    public function Product()
    {
        return $this->belongsTo(Product::class);
    }

    public function items() 
    {
        return $this->hasMany(OrderItem::class);
    }
}
