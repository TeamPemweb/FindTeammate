<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectApplication extends Model
{
    protected $primaryKey = 'appl_id';
    protected $fillable = [
        'user_id', 'project_id', 'roles_id', 
        'status_lamaran', 'jawaban_pertanyaan'
    ];

    protected $casts = [
        'jawaban_pertanyaan' => 'array',
        'applied_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id', 'project_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'roles_id', 'roles_id');
    }
}