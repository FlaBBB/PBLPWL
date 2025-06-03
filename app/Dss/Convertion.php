<?php

namespace App\Dss;

use App\Enums\CompetitionLevelEnum;

class Convertion {
    public static function placeToScore(int $place): int
    {
        switch ($place) {
            case 1:
                return 3;
            case 2:
                return 2;
            case 3:
                return 1;
            default:
                throw new \Exception("Invalid state");
        }
    }

    public static function totalMembersToScore(int $amount): int
    {
        if ($amount === 1) {
            return 3;
        } else if ($amount <= 3) {
            return 2;
        } else if ($amount > 3) {
            return 1;
        } else {
            throw new \Exception("Invalid state");
        }
    }

    public static function levelCompetitionToScore(CompetitionLevelEnum $level): int
    {
        switch ($level) {
            case CompetitionLevelEnum::INTERNATIONAL:
                return 10;
            case CompetitionLevelEnum::NATIONAL:
                return 5;
            case CompetitionLevelEnum::PROVINCE:
                return 3;
            case CompetitionLevelEnum::CITY:
            case CompetitionLevelEnum::INTERNAL:
                return 1;
            default:
                throw new \Exception("Invalid state");
        }
    }
}