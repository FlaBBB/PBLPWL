<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetitionTag extends Model
{
    use HasFactory;

    protected $table = 'competition_tag';
    public $incrementing = false;
    protected $primaryKey = null;
    public $timestamps = false;

    protected $fillable = [
        "id_competition",
        "id_tag"
    ];

    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class, 'id_competition', 'id');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }
}
