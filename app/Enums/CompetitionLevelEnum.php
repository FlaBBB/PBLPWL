<?php

namespace App\Enums;

enum CompetitionLevelEnum: string
{
    case INTERNAL = 'INTERNAL';
    case CITY = 'CITY';
    case PROVINCE = 'PROVINCE';
    case NATIONAL = 'NATIONAL';
    case INTERNATIONAL = 'INTERNATIONAL';
}
