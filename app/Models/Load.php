<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Load extends Model
{
    protected $fillable = [
        'company_id','vehicle_id','date',
        'rate_per_load','load_count',
        'total_amount','amount_paid','locked_at',
    ];

    protected $casts = [
        'date' => 'date',
        'locked_at' => 'datetime',
    ];

    public function company(): BelongsTo { return $this->belongsTo(Company::class); }
    public function vehicle(): BelongsTo { return $this->belongsTo(Vehicle::class); }
    public function labourLoads(): HasMany { return $this->hasMany(LabourLoad::class); }

    public function isLocked(): bool
    {
        if ($this->locked_at) return true;
        if (!$this->created_at) return false;
        return $this->created_at->lt(Carbon::now()->subDays(2));
    }

    public function balance(): float
    {
        return (float)$this->total_amount - (float)$this->amount_paid;
    }
}
