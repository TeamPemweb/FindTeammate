<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'prodi',           
        'angkatan',        
        'bio',             
        'kontak',          
        'foto_profil_url', 
        'role',          
        'status',           
        'suspended_until',
        'otp',             
        'otp_expires_at',  
        'is_verified',     
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
            'suspended_until' => 'datetime',
            'is_verified' => 'boolean',
        ];
    }
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class, 'user_id', 'id');
    }
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'user_skills', 'user_id', 'skill_id');
    }
    public function ownedProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'user_id', 'id');
    }
    public function applications(): HasMany
    {
        return $this->hasMany(ProjectApplication::class, 'user_id', 'id');
    }
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }
}
