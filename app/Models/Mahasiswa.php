<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = "nim";
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        "nim",
        "id_user",
        "name",
        "phone_number",
        "city",
        "district",
        "subdistrict",
        "address",
        "prodi",
        "grade"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mark(): HasOne
    {
        return $this->hasOne(Mark::class, 'nim', 'nim');
    }

    public function preferences(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'mahasiswa_preferences', 'nim', 'id_tag');
    }
}
