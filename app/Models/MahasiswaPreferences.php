<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MahasiswaPreferences extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_preferences';
    public $incrementing = false;
    protected $primaryKey = null;

    protected $fillable = [
        "nim",
        "id_tag"
    ];
    public $timestamps = false;

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }
}
