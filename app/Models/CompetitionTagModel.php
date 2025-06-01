<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetitionTagModel extends Model
{
    use HasFactory;

    protected $table = 'competition_tag';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "id_competition",
        "id_tag"
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(CompetitionModel::class, 'id_competition', 'id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'id_tag', 'id');
    }
}
