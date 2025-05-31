<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupervisorAchievementModel extends Model
{
    use HasFactory;

    protected $fillable = [
        ""
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(RoleSupervisorModel::class, 'id_role', 'id');
    }
}
