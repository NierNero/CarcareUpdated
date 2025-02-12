<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Service extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'mechanic_id' // Add mechanic_id to the fillable array
    ];

    public function mechanic()
     {
        return $this->belongsTo(Mechanic::class, 'mechanic_id');
     }

}
