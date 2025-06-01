<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Mark extends Model
{
    use HasFactory;

    protected $table = 'mark';

    public $incrementing = false;

    protected $primaryKey = null;

    protected $fillable = [
        "nim",
        "ipk",
        "updated_by"
    ];

    
    public $timestamps = false;

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'nip');
    }
}
