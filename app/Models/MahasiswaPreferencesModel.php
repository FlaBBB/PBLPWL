<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaPreferencesModel extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_preferences';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "nim",
        "id_tag"
    ];

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(MahasiswaModel::class, 'nim', 'nim');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(TagModel::class, 'id_tag', 'id');
    }
}
