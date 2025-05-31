<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AchievementModel extends Model
{
    use HasFactory;

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(MahasiswaModel::class, 'mahasiswa_achievement', 'id_achievement', 'nim');
    }

    public function supervisor(): BelongsToMany
    {
        return $this->belongsToMany(DosenModel::class, 'supervisor_achievement', 'id_achievement', 'id_dosen');
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'verificator', 'id');
    }
}
