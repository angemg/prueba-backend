<?php

namespace App\Models;

use App\Http\Controllers\Api\V1\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function company(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }
}
