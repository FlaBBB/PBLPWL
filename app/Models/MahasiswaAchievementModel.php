<?php

namespace App\Models;

use App\Enums\MahasiswaAchievementRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaAchievementModel extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "id_achievement",
        "nim",
        "role",
        "id_tag"
    ];

    protected $casts = [
        'role' => MahasiswaAchievementRoleEnum::class,
    ];

    public function achievement(): BelongsTo
    {
        return $this->belongsTo(AchievementModel::class, 'id_achievement', 'id');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(MahasiswaModel::class, 'nim', 'nim');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'id_tag', 'id');
    }
}
