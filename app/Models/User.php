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
        'identification',
        'birthdate',
        'sex',
        'telephone',
        'whatsapp',
        'tutor',
        'address',
        'height',
        'weight',
        'body_index',
        'injuries',
        'sick',
        'sport_Activity',
        'contact_emergency',
        'blood_type',
        'email',
        'role_as',
        'anemia',
        'suffocation',
        'asthmatic',
        'epileptic',
        'diabetic',
        'smoke',
        'dizzines',
        'fainting',
        'nausea',
        'password',
        'is_routine'
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
}
