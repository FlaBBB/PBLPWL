<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleSupervisorModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "description"
    ];

    public function supervisorAchievement(): HasMany
    {
        return $this->hasMany(SupervisorAchievementModel::class, 'role', 'id');
    }
}
