<?php

namespace App\Models;

use App\Enums\AchievementStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AchievementModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "upload_at",
        "competition_type",
        "competition_name",
        "competition_name_english",
        "competition_location",
        "competition_location_english",
        "competition_url",
        "start_date",
        "end_date",
        "pt_partition_number",
        "partition_number",
        "assignment_letter_number",
        "assignment_letter_date",
        "file_assignment_letter",
        "file_certificate",
        "file_activity_photo",
        "file_poster",
        "status",
        "note",
        "verificator",
        "verification_at",
    ];

    protected $casts = [
        'status' => AchievementStatusEnum::class,
        'upload_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
        'assignment_letter_date' => 'date',
        'verification_at' => 'datetime',
    ];

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(MahasiswaModel::class, 'mahasiswa_achievement', 'id_achievement', 'nim');
    }

    public function supervisor(): BelongsToMany
    {
        return $this->belongsToMany(DosenModel::class, 'supervisor_achivement', 'id_achievement', 'nidn');
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'verificator', 'nip');
    }
}
