<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = ['name', 'phone', 'address'];

    public function loads(): HasMany
    {
        return $this->hasMany(Load::class);
    }

    public function accountTransactions(): HasMany
    {
        return $this->hasMany(AccountTransaction::class);
    }
}
