<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    public $timestamps = false;

    protected $fillable = [
        "name"
    ];

    public function mahasiswaPreferences(): HasMany
    {
        return $this->hasMany(MahasiswaPreferences::class, 'id_tag', 'id');
    }

    public function competitionTags(): HasMany
    {
        return $this->hasMany(CompetitionTag::class, 'id_tag', 'id');
    }

    public function mahasiswaAchievement(): HasMany
    {
        return $this->hasMany(MahasiswaAchievement::class, 'id_tag', 'id');
    }
}
