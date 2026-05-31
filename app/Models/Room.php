<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_number',
        'price',
<<<<<<< HEAD
        'room_type', // <-- Added to allow mass-assignment
=======
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
        'status',
    ];
}