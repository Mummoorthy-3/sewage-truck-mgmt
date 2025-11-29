<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = ['name','registration_number'];

    public function loads(): HasMany { return $this->hasMany(Load::class); }
    public function logs(): HasMany { return $this->hasMany(VehicleLog::class); }
    public function maintenances(): HasMany { return $this->hasMany(VehicleMaintenance::class); }
}
