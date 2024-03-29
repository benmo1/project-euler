<?php

namespace MorrisPhp\ProjectEuler\Solution;

use MorrisPhp\ProjectEuler\SolutionInterface;

/**
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9. The sum of these multiples is 23.
 *
 * Find the sum of all the multiples of 3 or 5 below 1000.
 */
class MultiplesOf3And5 implements SolutionInterface
{
    const DIVISORS = [3, 5];
    const N = 1000;

    public function calculate()
    {
        // counters mean we dont need to divide by the divisors for each $n
        // computer division A / B scales with O(N) because it recursively
        // subtracts B until remainder < A, this solution does not
        $counters = array_fill(0, count(self::DIVISORS), 0);
        $sum = 0;

        for ($n = 1; $n < self::N; $n++) {
            $this->updateCounters($counters);
            if ($this->isMatch($counters)) {
                $sum += $n;
            }
        }

        return $sum;
    }

    private function updateCounters(array &$counters)
    {
        array_walk($counters, function (&$c, $i) {
            $c = ++$c % self::DIVISORS[$i];
        });
    }

    private function isMatch(array $counters)
    {
        return in_array(0, $counters);
    }
}
