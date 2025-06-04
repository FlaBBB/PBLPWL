<?php

namespace App\Models;

use App\Enums\CompetitionLevelEnum;
use App\Enums\AchievementStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_achievement', 'id_achievement', 'nim');
    }

    public function supervisor(): BelongsToMany
    {
        return $this->belongsToMany(Dosen::class, 'supervisor_achievement', 'id_achievement', 'nidn');
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'verificator', 'nip');
    }
}
