<?php

namespace App\Models;

use App\Enums\AchievementStatusEnum;
use App\Enums\CompetitionLevelEnum;
use App\Enums\MahasiswaAchievementRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievement';
    public $timestamps = false;

    protected $fillable = [
        "upload_at",
        "competition_type",
        "competition_name",
        "competition_name_english",
        "competition_location",
        "competition_location_english",
        "competition_url",
        "start_at",
        "end_at",
        "pt_partition_number",
        "partition_number",
        "assignment_letter_number",
        "assignment_letter_date",
        "file_assignment_letter",
        "file_certificate",
        "file_activity_photo",
        "file_poster",
        "level",
        "place",
        "status",
        "note",
        "verificator",
        "verification_at",
    ];

    protected $casts = [
        'level' => CompetitionLevelEnum::class,
        'status' => AchievementStatusEnum::class,
        'upload_at' => 'datetime',
        'start_at' => 'date',
        'end_at' => 'date',
        'assignment_letter_date' => 'date',
        'verification_at' => 'datetime',
    ];

    public function mahasiswaAchievements(): HasMany
    {
        return $this->hasMany(MahasiswaAchievement::class, 'id_achievement', 'id');
    }

    public function supervisorAchievements(): HasMany
    {
        return $this->hasMany(SupervisorAchievement::class, 'id_achievement', 'id');
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_achievement', 'id_achievement', 'nim')->withPivot('role');
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'verificator', 'nip');
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'mahasiswa_achievement', 'id_achievement', 'id_tag');
    }

    // Accessor for nama_mahasiswa
    public function getNamaMahasiswaAttribute(): string
    {
        $mahasiswa = $this->mahasiswa;

        if ($mahasiswa->isEmpty()) {
            return 'N/A';
        }

        // If there's only one student, return their name
        if ($mahasiswa->count() === 1) {
            return $mahasiswa->first()->name;
        }

        // If there are multiple students, find the leader
        $leader = $mahasiswa->firstWhere('pivot.role', MahasiswaAchievementRoleEnum::LEADER->value);

        // Return leader's name if found, otherwise N/A
        return $leader ? $leader->name : 'N/A';
    }
}
