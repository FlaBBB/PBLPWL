<?php

namespace App\Dss;

class Smart
{
    public static function calculate(array $alternatives, array $criteria): array
    {
        $results = [];

        // 1. Extract and Normalize Weights
        $weights = [];
        $totalWeight = 0;
        foreach ($criteria as $criterionName => $details) {
            $weight = (float) $details['weight'];
            $weights[$criterionName] = $weight;
            $totalWeight += $weight;
        }

        $normalizedWeights = [];
        if ($totalWeight > 0) {
            foreach ($weights as $criterionName => $weight) {
                $normalizedWeights[$criterionName] = $weight / $totalWeight;
            }
        } else {
            // Handle case where total weight is zero to avoid division by zero
            foreach ($weights as $criterionName => $weight) {
                $normalizedWeights[$criterionName] = 0;
            }
        }
        $results['normalized_weights'] = $normalizedWeights;

        // 2. Max & min of alternative for each criteria
        $minMaxValues = [];
        foreach ($criteria as $criterionName => $details) {
            $values = array_column($alternatives, $criterionName);
            $minMaxValues[$criterionName]['min'] = min($values);
            $minMaxValues[$criterionName]['max'] = max($values);
        }
        $results['max_min_alternatives'] = $minMaxValues;

        // 3. Calculate Utility Alternative (Normalized Utility Values)
        $utilityAlternatives = [];
        foreach ($alternatives as $altKey => $alternative) {
            $utilityAlternatives[$altKey] = [
                'name' => $alternative['name'] ?? $altKey,
                'id_user' => $alternative['id_user'] ?? null, // Preserve id_user
            ];
            foreach ($criteria as $criterionName => $details) {
                $value = $alternative[$criterionName];
                $min = $minMaxValues[$criterionName]['min'];
                $max = $minMaxValues[$criterionName]['max'];

                $denominator = ($max - $min);
                if ($denominator == 0) {
                    $utilityValue = 0; // All values are the same for this criterion
                } else {
                    $utilityValue = ($value - $min) / $denominator;
                }
                $utilityAlternatives[$altKey][$criterionName] = $utilityValue;
            }
        }
        $results['utility_alternative'] = $utilityAlternatives;

        // 4. Calculate Final Result (Weighted Sum and Ranking)
        $finalScores = [];
        foreach ($utilityAlternatives as $altKey => $utilityAlternative) {
            $score = 0;
            foreach ($criteria as $criterionName => $details) {
                $score += $utilityAlternative[$criterionName] * $normalizedWeights[$criterionName];
            }
            $finalScores[$altKey] = $score;
        }

        // Rank alternatives based on scores (descending order for SMART, higher is better)
        arsort($finalScores);

        $rankedAlternatives = [];
        foreach ($finalScores as $altKey => $score) {
            $rankedAlternatives[] = [
                'alternative' => $alternatives[$altKey]['name'] ?? $altKey,
                'score' => $score,
                'id_user' => $alternatives[$altKey]['id_user'] ?? null, // Preserve id_user
            ];
        }
        $results['final_ranking'] = $rankedAlternatives;

        return $results;
    }
}
