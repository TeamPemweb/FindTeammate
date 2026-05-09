<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $primaryKey = 'project_id';
    protected $fillable = [
        'user_id', 'nama_proyek', 'deskripsi', 'status_proyek', 
        'periode_awal', 'periode_akhir', 'bidang', 'informasi_pelamar'
    ];

    protected $casts = [
        'bidang' => 'array',
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'project_id', 'project_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(ProjectApplication::class, 'project_id', 'project_id');
    }
}