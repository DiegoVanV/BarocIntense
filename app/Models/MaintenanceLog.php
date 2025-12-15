<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    protected $fillable = [
        'machine_id',
        'maintenance_order_id',
        'gebruiker',
        'omschrijving',
        'toegevoegd_op',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function order()
    {
        return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id');
    }
}
