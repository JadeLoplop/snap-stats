<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $casts = [
        'day' => 'date:Y-m-d',
    ];

    protected $fillable = [
        'day',
        'country_id',
        'platform_id',
        'publisher_id',
        'impressions',
        'conversions',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
}
