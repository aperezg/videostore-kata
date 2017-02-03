<?php

namespace Domain\Service\MovieRenter;

use Domain\Model\Movie\Movie;
use Domain\Model\Movie\MovieType;

class DetermineFrequentRenterPoints
{
    /** @var Movie $movie */
    private $movie;

    /**
     * DetermineFrequentRenterPoints constructor.
     * @param Movie $movie
     */
    private function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param Movie $movie
     * @return DetermineFrequentRenterPoints
     */
    public static function instance(Movie $movie) : self
    {
        return new static($movie);
    }

    /**
     * @param $daysRented
     * @return int
     */
    public function calculateByRentedDays($daysRented): int
    {
        $frequentRenterPoints = 1;
        if ($this->movie->movieType()->type() == MovieType::NEW_RELEASE_TYPE && $daysRented > 1) {
            $frequentRenterPoints++;
        }

        return $frequentRenterPoints;
    }
}