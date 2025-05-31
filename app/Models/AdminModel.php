<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AdminModel extends Model
{
    use HasFactory;

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function mahasiswaMark(): HasMany
    {
        return $this->hasMany(MarkModel::class, 'updated_by', 'nip');
    }

    public function achievement(): HasMany
    {
        return $this->hasMany(AchievementModel::class, 'verificator', 'nip');
    }

    public function competition(): HasMany
    {
        return $this->hasMany(CompetitionModel::class, 'verificator', 'nip');
    }
}
