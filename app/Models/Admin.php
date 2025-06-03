<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = "nip";
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        "nip",
        "id_user",
        "name"
    ];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mahasiswaMark(): HasMany
    {
        return $this->hasMany(Mark::class, 'updated_by', 'nip');
    }

    public function achievement(): HasMany
    {
        return $this->hasMany(Achievement::class, 'verificator', 'nip');
    }

    public function competition(): HasMany
    {
        return $this->hasMany(Competition::class, 'verificator', 'nip');
    }
}
