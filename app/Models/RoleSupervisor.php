<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleSupervisor extends Model
{
    use HasFactory;

    protected $table = 'role_supervisor';
    public $timestamps = false;

    protected $fillable = [
        "description"
    ];

    public function supervisorAchievement(): HasMany
    {
        return $this->hasMany(SupervisorAchievement::class, 'role', 'id');
    }
}
