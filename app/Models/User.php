<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'identity_card_number',
        'name',
        'birthplace',
        'email',
        'gender',
        'mobile_phone',
        'address',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'rt',
        'rw',
        'postcode',
        'photo',
        'is_active',
        'password',

        // employment
        'hire_date',
        'termination_date',
        'salary',
        'employment_status',

        // additional
        'remember_token',
        'email_verified_at',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
            $model->uuid = $model->generateUuid();
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }

    private function generateUuid($length = 10)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

        do {
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
        } while ($this->isUuidExist($randomString));

        return $randomString;
    }

    private function isUuidExist($uuid)
    {
        return self::where('uuid', $uuid)->exists();
    }

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

    // Scope untuk user yang tidak memiliki role masteradmin atau superadmin
    public function scopeAdmin($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->where('name', 'like', 'admin_%'); // Filter berdasarkan prefix 'admin_'
        });
    }

    // Scope untuk user yang tidak memiliki role masteradmin atau superadmin
    public function scopeNonAdmin($query)
    {
        return $query->whereHas('roles', function ($q) {
            $q->whereNotIn('name', ['masteradmin', 'superadmin', 'admin', 'customer']);
        });
    }

    public function scopeCustomer($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        });
    }

    public function scopeDriver($query)
    {
        return $query->whereHas('roles', function ($query) {
            $query->where('name', 'driver');
        });
    }

    public static function getLatestCustomers($limit = 5)
    {
        return self::customer()->latest()->take($limit)->get();
    }

    public static function getTotalRows()
    {
        return self::count();
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'customer_id');
    }

    public function driverBookings()
    {
        return $this->hasMany(BookingDriver::class, 'driver_id');
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class, 'employee_id');
    }

    public function createdHistories()
    {
        return $this->hasMany(PayrollHistory::class, 'created_by');
    }

    public function updatedHistories()
    {
        return $this->hasMany(PayrollHistory::class, 'updated_by');
    }
}
