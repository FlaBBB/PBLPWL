<?php

namespace App\Enums;

enum AchievementStatusEnum: string
{
    case WAITING = 'WAITING';
    case REVISION = 'REVISION';
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
}
