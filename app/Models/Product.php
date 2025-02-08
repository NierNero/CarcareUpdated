<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Authenticatable
{
    use HasFactory, Notifiable;
    
    //protected $primaryKey = 'ProductID';

    protected $fillable = [
        'ProductName',
        'Description',
        'Price',
        'Inventory',
        'mechanic_id', // Add mechanic_id to the fillable array
    ];

     // A product belongs to a user
     public function user()
     {
        return $this->belongsTo(Mechanic::class);
     }
}
