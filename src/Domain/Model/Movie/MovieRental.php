<?php

namespace Domain\Model\Movie;


class MovieRental
{
    /**
     * @var Movie
     */
    private $movie;

    /**
     * MovieRental constructor.
     * @param Movie $movie
     */
    private function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param Movie $movie
     * @return MovieRental
     */
    public static function instance(Movie $movie) : self
    {
        return new static($movie);
    }

    /**
     * @param int $daysRented
     * @return float
     */
    public function determineAmount(int $daysRented): float
    {
        $amount = 0;

        switch ($this->movie->movieType()->type()) {
            case MovieType::REGULAR_TYPE:
                $amount = $this->determineAmountForRegularType($daysRented);
                break;
            case MovieType::CHILDREN_TYPE:
                $amount = $this->determineAmountForChildrenType($daysRented);
                break;
            case MovieType::NEW_RELEASE_TYPE:
                $amount = $this->determineAmountForNewReleaseType($daysRented);
                break;
        }

        return $amount;
    }

    /**
     * @param int $daysRented
     * @return float
     */
    private function determineAmountForRegularType(int $daysRented): float
    {
        $amount = 2;

        if ($daysRented > 2) {
            $amount += ($daysRented - 2) * 1.5;
        }

        return $amount;
    }

    /**
     * @param int $daysRented
     * @return float
     */
    private function determineAmountForChildrenType(int $daysRented): float
    {
        $amount = 1.5;

        if ($daysRented > 3) {
            $amount += ($daysRented - 3) * 1.5;
        }

        return $amount;
    }

    /**
     * @param int $daysRented
     * @return float
     */
    private function determineAmountForNewReleaseType(int $daysRented): float
    {
        return $daysRented * 3.0;
    }

    /**
     * @param $daysRented
     * @return int
     */
    public function determineFrequentRenterPoints($daysRented): int
    {
        $frequentRenterPoints = 1;
        if ($this->movie->movieType()->type() == MovieType::NEW_RELEASE_TYPE && $daysRented > 1) {
            $frequentRenterPoints++;
        }

        return $frequentRenterPoints;
    }
}