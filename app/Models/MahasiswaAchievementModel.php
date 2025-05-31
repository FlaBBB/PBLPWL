<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaAchievementModel extends Model
{
    use HasFactory;

    public function tag(): BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'id_tag', 'id');
    }
}
