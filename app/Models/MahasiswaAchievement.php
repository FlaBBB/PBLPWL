<?php

namespace App\Models;

use App\Enums\MahasiswaAchievementRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaAchievement extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_achievement';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;

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
        return $this->belongsTo(Achievement::class, 'id_achievement', 'id');
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }
}
