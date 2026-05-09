<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $primaryKey = 'roles_id';
    protected $fillable = ['project_id', 'nama_peran', 'deskripsi_peran', 'jumlah_dibutuhkan'];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(ProjectApplication::class, 'roles_id', 'roles_id');
    }
}