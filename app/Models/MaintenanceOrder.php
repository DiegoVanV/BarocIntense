<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceOrder extends Model
{
    protected $fillable = [
        'machine_id',
        'titel',
        'beschrijving',
        'status', // ingepland, bezig, afgerond
        'gepland_op',
        'uitgevoerd_op',
    ];

    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function logs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
