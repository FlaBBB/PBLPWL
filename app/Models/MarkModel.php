<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MarkModel extends Model
{
    use HasFactory;

    public function mahasiswa(): HasOne
    {
        return $this->hasOne(MahasiswaModel::class, 'nim', 'nim');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(AdminModel::class, 'updated_by', 'id');
    }
}
