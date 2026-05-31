<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
<<<<<<< HEAD
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'tenant_id', 
        'room_number', 
        'amount',
        'date',
        'status',
        'reference_number',
        'receipt_path',
    ];

    /**
     * The model's default values for attributes.
     */
    protected $attributes = [
        'status' => 'Pending',
    ];

    /**
     * 👇 ADDED: Casts attributes to native types or Carbon instances
     */
    protected $casts = [
        'date'   => 'datetime',
        'amount' => 'decimal:2',
    ];

    /**
     * Get the tenant associated with the payment record.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id');
    }
=======
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'amount',
        'date',
        'status',
    ];
>>>>>>> 0c223bd492001434a0baf1bdce431350fcbb7e5b
}