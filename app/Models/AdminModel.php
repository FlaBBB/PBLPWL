<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminModel extends Model
{
    use HasFactory;

    protected $primaryKey = "nip";

    protected $keyType = 'string';

    protected $fillable = [
        "nip",
        "id_user",
        "name"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mahasiswaMark(): HasMany
    {
        return $this->hasMany(MarkModel::class, 'updated_by', 'nip');
    }

    public function achievement(): HasMany
    {
        return $this->hasMany(AchievementModel::class, 'verificator', 'nip');
    }

    public function competition(): HasMany
    {
        return $this->hasMany(CompetitionModel::class, 'verificator', 'nip');
    }
}
