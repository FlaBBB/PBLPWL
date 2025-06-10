<?php

namespace App\Enums;

enum AchievementStatusEnum: string
{
    case WAITING = 'WAITING';
    case REVISION = 'REVISION';
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
    public function getLabel(): string
    {
        return match ($this) {
            self::WAITING => 'Menunggu',
            self::REVISION => 'Revisi',
            self::ACCEPTED => 'Terverifikasi',
            self::REJECTED => 'Ditolak',
        };
    }
}
