<?php

namespace App\Models;

use App\Enums\CompetitionLevelEnum;
use App\Enums\CompetitionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competition extends Model
{
    use HasFactory;

    protected $table = 'competition';
    public $timestamps = false;

    protected $fillable = [
        "name",
        "description",
        "level",
        "poster",
        "organizer",
        "start_at",
        "end_at",
        "registration_deadline",
        "registration_link",
        "registration_fee",
        "max_participation_amount",
        "creator",
        "status",
        "rejection_note",
        "verificator",
        "verification_date",
    ];

    protected $casts = [
        'level' => CompetitionLevelEnum::class,
        'status' => CompetitionStatusEnum::class,
        'start_at' => 'date',
        'end_at' => 'date',
        'registration_deadline' => 'date',
        'verification_date' => 'date',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }

    public function verificator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'verificator', 'nip');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'competition_tag', 'id_competition', 'id_tag');
    }
}
