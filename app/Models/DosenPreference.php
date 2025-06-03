<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenPreference extends Model
{
    use HasFactory;

    protected $table = 'dosen_preferences';
    protected $primaryKey = ['nidn', 'id_tag'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'nidn',
        'id_tag',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'id_tag', 'id');
    }
}
