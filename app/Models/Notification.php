<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $primaryKey = 'id_notif';
    protected $fillable = ['user_id', 'pesan', 'tipe_notifikasi', 'status_baca', 'tanggal_baca'];

    protected $casts = [
        'status_baca' => 'boolean',
        'tanggal_baca' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}