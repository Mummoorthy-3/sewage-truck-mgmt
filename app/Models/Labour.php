<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Labour extends Model
{
    protected $fillable = [
        'name','address','phone','aadhaar_number',
        'emergency_contact_name','emergency_contact_phone'
    ];

    public function attendances(): HasMany { return $this->hasMany(Attendance::class); }
    public function labourLoads(): HasMany { return $this->hasMany(LabourLoad::class); }
    public function advances(): HasMany { return $this->hasMany(Advance::class); }
    public function salaries(): HasMany { return $this->hasMany(Salary::class); }
    public function extraIncomes(): HasMany { return $this->hasMany(ExtraIncome::class); }
}
