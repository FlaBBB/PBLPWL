<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosenModel extends Model
{
    use HasFactory;

    protected $primaryKey = "nidn";
    protected $keyType = 'string';

    protected $fillable = [
        "nidn",
        "id_user",
        "firstname",
        "lastname",
        "name"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
