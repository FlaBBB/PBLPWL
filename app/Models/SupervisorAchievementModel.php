<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupervisorAchievementModel extends Model
{
    use HasFactory;

    protected $table = 'supervisor_achivement';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "id_achievement",
        "nidn",
        "role"
    ];

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(AchievementModel::class, 'id_achievement', 'id');
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(DosenModel::class, 'nidn', 'nidn');
    }

    public function roleSupervisor(): BelongsTo
    {
        return $this->belongsTo(RoleSupervisorModel::class, 'role', 'id');
    }
}
