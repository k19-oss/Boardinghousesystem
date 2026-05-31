<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTicket extends Model
{
    use HasFactory;

    // Directs the model to link up with your migrated table
    protected $table = 'maintenance_tickets';

    // Mass fillable fields required for form submissions
    protected $fillable = [
        'tenant_id',
        'category',
        'description',
        'status',
    ];
}