<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupervisorAchievement extends Model
{
    use HasFactory;

    protected $table = 'supervisor_achievement';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "id_achievement",
        "nidn",
        "role"
    ];
    public $timestamps = false;

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(Achievement::class, 'id_achievement', 'id');
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function roleSupervisor(): BelongsTo
    {
        return $this->belongsTo(RoleSupervisor::class, 'role', 'id');
    }
}
