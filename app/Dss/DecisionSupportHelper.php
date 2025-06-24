<?php

namespace App\Dss;

use App\Dss\Vikor;
use App\Dss\Smart;

class DecisionSupportHelper
{
    private static array $criteria = [
        "IPK" => [
            "desc" => "IPK/GPA from the each mahasiswa",
            "weight" => 0.3,
            "type" => "benefit" // Added type for clarity
        ],
        "Achievement" => [
            "desc" => "Score of achievement mahasiswa, this score is taken from adding place score, category score, and level score",
            "weight" => 0.45,
            "type" => "benefit"
        ], 
        "Frequency" => [
            "desc" => "Frequency of achievement",
            "weight" => 0.25,
            "type" => "benefit"
        ]
    ];

    public static function getCriteria(): array
    {
        return self::$criteria;
    }

    /**
     * Calculates the ranking using the VIKOR method.
     *
     * @param array $alternatives An array of alternatives, each with performance values for criteria.
     *                            Example: [['name' => 'Alt1', 'IPK' => 3.5, 'Achievement' => 80, 'Frequency' => 5], ...]
     * @param float $v The weight of the strategy of "the majority of criteria" (0 to 1).
     * @return array Ranked alternatives.
     */
    public static function calculateVikor(array $alternatives, float $v = 0.5): array
    {
        return Vikor::calculate($alternatives, self::$criteria, $v);
    }

    /**
     * Calculates the ranking using the SMART method.
     *
     * @param array $alternatives An array of alternatives, each with performance values for criteria.
     *                            Example: [['name' => 'Alt1', 'IPK' => 3.5, 'Achievement' => 80, 'Frequency' => 5], ...]
     * @return array Ranked alternatives.
     */
    public static function calculateSmart(array $alternatives): array
    {
        return Smart::calculate($alternatives, self::$criteria);
    }
}
