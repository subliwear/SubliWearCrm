<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    public function is_admin(){
        return isset($this->admin);
    }

    public function is_manager(){
        return isset($this->manager);
    }

    public function is_customer(){
        return isset($this->customer);
    }

    public function admin(){
        return $this->hasOne('App\Models\Admin');
    }

    public function manager(){
        return $this->hasOne('App\Models\Manager');
    }

    public function customer(){
        return $this->hasOne('App\Models\Customer');
    }
}
