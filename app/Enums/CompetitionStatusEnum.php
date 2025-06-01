<?php

namespace App\Enums;

enum CompetitionStatusEnum: string
{
    case WAITING = 'WAITING';
    case ACCEPTED = 'ACCEPTED';
    case REJECTED = 'REJECTED';
}
