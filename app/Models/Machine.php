<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    protected $fillable = [
        'naam',
        'type',
        'serienummer',
        'status', // operationeel, storing, gepland_onderhoud
        'specificaties', // json of tekst
    ];

    public function onderhoudsorders()
    {
        return $this->hasMany(MaintenanceOrder::class);
    }

    public function logs()
    {
        return $this->hasMany(MaintenanceLog::class);
    }
}
