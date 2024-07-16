<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    public function getPeriodDateAttribute()
    {
        return Carbon::parse($this->attributes['period_date'])
            ->translatedFormat('d F Y');
    }
}
