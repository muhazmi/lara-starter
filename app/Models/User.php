<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\Village;
use Spatie\Permission\Traits\HasRoles;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'identity_card_number',
        'email',
        'email',
        'gender',
        'phone',
        'address',
        'rt',
        'rw',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'postcode',
        'profile_image',
        'password',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getAllList()
    {
        return self::with(['province', 'city', 'district', 'village'])
            ->select(
                'users.id',
                'users.name',
                'users.identity_card_number',
                'users.phone',
                'users.address',
                'users.rt',
                'users.rw',
                'users.postcode',
                'provinces.name as province_name',
                'cities.name as city_name',
                'districts.name as district_name',
                'villages.name as village_name',
                'users.is_active',
            )
            ->leftJoin('provinces', 'users.province_id', '=', 'provinces.code')
            ->leftJoin('cities', 'users.city_id', '=', 'cities.code')
            ->leftJoin('districts', 'users.district_id', '=', 'districts.code')
            ->leftJoin('villages', 'users.village_id', '=', 'villages.code')
            ->get();
    }

    public static function getTotalRows()
    {
        return self::count();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'code');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'code');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'code');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'code');
    }
}
