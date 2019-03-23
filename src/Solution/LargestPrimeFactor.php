<?php

namespace MorrisPhp\ProjectEuler\Solution;

use MorrisPhp\ProjectEuler\SolutionInterface;

/**
 * The prime factors of 13195 are 5, 7, 13 and 29.
 *
 * What is the largest prime factor of the number 600851475143 ?
 */
class LargestPrimeFactor implements SolutionInterface
{
    const N = 600851475143;

    /**
     * Find largest prime factor of $n
     *
     * @return int
     */
    public function calculate()
    {
        $factorPairs = [new FactorPair(1, static::N, static::N)];

        while ($pair = $this->nextPair(end($factorPairs))) {
            if ($this->isPrime($pair->high)) {
                return $pair->high;
            }
            $factorPairs[] = $pair;
        }

        foreach (array_reverse($factorPairs) as $pair) {
            if ($this->isPrime($pair->low)) {
                return $pair->low;
            }
        }

        return null;
    }

    /**
     * Get the next factor pair to try
     *
     * @param FactorPair $pair
     *
     * @return FactorPair
     */
    private function nextPair(FactorPair $pair): ?FactorPair
    {
        $i = $pair->low;
        $root = sqrt($pair->n);

        while (++$i && $i <= $root) {
            if ($pair->n % $i === 0) {
                return new FactorPair($i, $pair->n / $i, $pair->n);
            }
        }

        return null;
    }

    /**
     * Determine whether $n is prime
     *
     * @param int $n
     *
     * @return bool
     */
    private function isPrime(int $n): bool
    {
        for ($i = 2; $i <= ($root ?? $root = sqrt($n)); $i++) {
            if ($n % $i === 0) {
                return false;
            }
        }

        return true;
    }

}

/**
 * A pair of factors of $n
 *
 * Class FactorPair
 */
class FactorPair
{
    /**
     * @var int
     */
    public $low;

    /**
     * @var int
     */
    public $high;

    /**
     * @var int
     */
    public $n;

    /**
     * FactorPair constructor.
     *
     * @param $low
     * @param $high
     * @param $n
     */
    public function __construct(int $low, int $high, int $n)
    {
        $this->low = $low;
        $this->high = $high;
        $this->n = $n;
    }
}
