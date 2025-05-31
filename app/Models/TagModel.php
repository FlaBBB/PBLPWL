<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TagModel extends Model
{
    use HasFactory;

    public function mahasiswaAchievement(): HasMany
    {
        return $this->hasMany(MahasiswaAchievementModel::class, 'id_tag', 'id');
    }
}
