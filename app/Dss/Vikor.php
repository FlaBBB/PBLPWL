<?php

namespace App\Dss;

class Vikor
{
    public static function calculate(array $alternatives, array $criteria, float $v = 0.5): array
    {
        $results = [];

        // Extract weights and identify benefit/cost criteria
        $weights = [];
        foreach ($criteria as $criterionName => $details) {
            $weights[$criterionName] = (float) $details['weight'];
        }
        $results['weights'] = $weights;

        // Step 1: Determine the best (f_star) and worst (f_minus) values for each criterion
        $f_star = []; // f* (best)
        $f_minus = []; // f- (worst)

        foreach ($criteria as $criterionName => $details) {
            $values = array_column($alternatives, $criterionName);
            $f_star[$criterionName] = max($values);
            $f_minus[$criterionName] = min($values);
        }
        $results['max_min_alternatives'] = [
            'f_star' => $f_star,
            'f_minus' => $f_minus,
        ];

        // Step 2: Calculate S (utility measure) and R (regret measure) for each alternative
        $s_values = [];
        $r_values = [];
        $normalized_differences = []; // To store normalized benefit/cost values
        $weighted_normalized_differences = []; // To store weighted normalized benefit/cost values

        foreach ($alternatives as $altKey => $alternative) {
            $s = 0;
            $r = 0;
            $normalized_diff_per_criterion = [];
            $weighted_normalized_diff_per_criterion = [];
            foreach ($criteria as $criterionName => $details) {
                $f_j = $alternative[$criterionName];
                $w_j = $weights[$criterionName];
                $f_star_j = $f_star[$criterionName];
                $f_minus_j = $f_minus[$criterionName];

                $denominator = ($f_star_j - $f_minus_j);
                if ($denominator == 0) {
                    $normalized_diff = 0;
                } else {
                    $normalized_diff = ($f_star_j - $f_j) / $denominator;
                }
                
                $weighted_normalized_diff = $w_j * $normalized_diff;
                $s += $weighted_normalized_diff;
                $r = max($r, $w_j * $normalized_diff);
                $normalized_diff_per_criterion[$criterionName] = $normalized_diff;
                $weighted_normalized_diff_per_criterion[$criterionName] = $weighted_normalized_diff;
            }
            $s_values[$altKey] = $s;
            $r_values[$altKey] = $r;
            $normalized_differences[$altKey] = $normalized_diff_per_criterion;
            $weighted_normalized_differences[$altKey] = $weighted_normalized_diff_per_criterion;
        }
        $results['normalized_benefit_alternative'] = $normalized_differences;
        $results['weighted_normalized_benefit_alternative'] = $weighted_normalized_differences;
        $results['utility_regret_measures'] = [
            'S_values' => $s_values,
            'R_values' => $r_values,
        ];

        // Step 3: Calculate Q (VIKOR index) for each alternative
        $q_values = [];
        $s_star = min($s_values);
        $s_minus = max($s_values);
        $r_star = min($r_values);
        $r_minus = max($r_values);

        $results['max_min_Si_Ri'] = [
            'S_star' => $s_star,
            'S_minus' => $s_minus,
            'R_star' => $r_star,
            'R_minus' => $r_minus,
        ];

        foreach ($alternatives as $altKey => $alternative) {
            $s_i = $s_values[$altKey];
            $r_i = $r_values[$altKey];

            $q_denominator_s = ($s_minus - $s_star);
            $q_denominator_r = ($r_minus - $r_star);

            $term1 = ($q_denominator_s == 0) ? 0 : ($s_i - $s_star) / $q_denominator_s;
            $term2 = ($q_denominator_r == 0) ? 0 : ($r_i - $r_star) / $q_denominator_r;

            $q_values[$altKey] = $v * $term1 + (1 - $v) * $term2;
        }

        // Step 4: Rank alternatives based on Q values (ascending order)
        asort($q_values);

        $rankedAlternatives = [];
        foreach ($q_values as $altKey => $q) {
            $rankedAlternatives[] = [
                'alternative' => $alternatives[$altKey]['name'] ?? $altKey,
                'Q' => $q,
                'S' => $s_values[$altKey],
                'R' => $r_values[$altKey],
            ];
        }
        $results['final_ranking'] = $rankedAlternatives;

        return $results;
    }
}
