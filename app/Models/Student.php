<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $casts = [
        'member_access' => 'json',
    ];

    protected $fillable = [
        'id',
        'user_id',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'address',
        'phone_number',
        'gender',
        'is_member', // true, false
        'member_access',
    ];

    protected $dates = [
        'member_expiration_date'
    ];

    public function getPhoneNumberAttribute($value)
    {
        $value = str_replace(" ","",$value);
        $value = str_replace("(","",$value);
        $value = str_replace(")","",$value);
        $value = str_replace(".","",$value);

        if(!preg_match('/[^+0-9]/',trim($value))){
            if(substr(trim($value), 0, 3)=='+62'){
                $result = trim($value);
            }

            elseif(substr(trim($value), 0, 1)=='0'){
                $result = '+62'.substr(trim($value), 1);
            } else {
                $result = $value;
            }
        }

        return str_replace("+" ,"", $result);
    }

    public function getMemberExpirationDateAttribute($value)
    {
        return empty($value) ? '-' : Carbon::parse($value)->format('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
