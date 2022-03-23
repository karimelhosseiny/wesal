<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];


    public function organization()
    {
        return $this->hasOne(Organization::class, 'creator_id');
    }


    public function favoriteCases()
    {
        return $this->belongsToMany(DonationCase::class, "favourite_cases", "user_id", "case_id");
    }

    public function donationOperations()
    {
        return $this->belongsToMany(DonationCase::class, "donation_operations", "user_id", "case_id")->withPivot("amount", "currency");
    }

    public function admin()
    {
        return $this->hasOne(Admin::class,'id');
    }

    public function reminders(){
        return $this->hasMany(Reminder::class,'user_id');
    }
}

