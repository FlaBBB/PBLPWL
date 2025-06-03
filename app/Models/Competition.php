<?php

namespace App\Models;

use App\Enums\CompetitionLevelEnum;
use App\Enums\CompetitionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Date;
use App\Models\Mahasiswa;
use App\Models\Tag;

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

    static public function getActiveCompetition()
    {
        return Competition::query()
            ->where("registration_deadline", ">", Date::now())
            ->get();
    }

    static public function getRecomendedCompetition(Mahasiswa $mahasiswa)
    {
        $mahasiswaPreferenceTags = $mahasiswa->preferences->pluck('id')->toArray();

        $mahasiswaAchievementTags = $mahasiswa->mahasiswaAchievements()
                                            ->with('tag')
                                            ->get()
                                            ->pluck('tag.id')
                                            ->toArray();

        $tagScores = [];

        foreach ($mahasiswaPreferenceTags as $tagId) {
            $tagScores[$tagId] = ($tagScores[$tagId] ?? 0) + 1; 
        }

        foreach ($mahasiswaAchievementTags as $tagId) {
            $tagScores[$tagId] = ($tagScores[$tagId] ?? 0) + 2; 
        }

        $activeCompetitions = Competition::query()
            ->where("registration_deadline", ">", Date::now())
            ->with('tags')
            ->get();

        $scoredCompetitions = [];

        foreach ($activeCompetitions as $competition) {
            $score = 0;
            foreach ($competition->tags as $tag) {
                if (isset($tagScores[$tag->id])) {
                    $score += $tagScores[$tag->id];
                }
            }
            if ($score > 0) {
                $scoredCompetitions[] = [
                    'competition' => $competition,
                    'score' => $score
                ];
            }
        }

        usort($scoredCompetitions, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        $recommended = array_map(function ($item) {
            return $item['competition'];
        }, $scoredCompetitions);

        return collect($recommended)->unique('id')->take(3);
    }
}
