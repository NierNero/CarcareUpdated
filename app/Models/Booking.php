<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default 'bookings'
    // protected $table = 'custom_bookings_table_name'; 

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'customer_name',
        'service',
        'booking_date',
        'booking_time',
    ];

    // Optionally, define a relationship to another model, such as User or Mechanic if needed
    // Example: if a booking belongs to a user or mechanic:
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // Add timestamps if your table has `created_at` and `updated_at`
    public $timestamps = true;
}
