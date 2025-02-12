<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mechanic_id']; // Ensure these foreign keys exist

    // Relationship to the Service model
    //public function service()
    //{
    //    return $this->belongsTo(Service::class);
    //}

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
