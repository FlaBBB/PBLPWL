<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MahasiswaModel extends Model
{
    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function mark(): BelongsTo
    {
        return $this->belongsTo(MarkModel::class, 'nim', 'nim');
    }

    public function preferences(): BelongsToMany
    {
        return $this->belongsToMany(TagModel::class, 'mahasiswa_preferences', 'nim', 'id_tag');
    }
}
