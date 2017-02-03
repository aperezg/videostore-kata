<?php

namespace Domain\Service\MovieRenter;


use Domain\Model\Movie\Movie;
use Domain\Model\Movie\MovieType;

class DetermineAmount
{
    /** @var  Movie */
    private $movie;

    /**
     * DetermineAmount constructor.
     * @param Movie $movie
     */
    private function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * @param Movie $movie
     * @return DetermineAmount
     */
    public static function instance(Movie $movie) : self
    {
        return new static($movie);
    }

    /**
     * @param int $daysRented
     * @return float
     */
    public function calculateByRentedDays(int $daysRented) : float
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
}