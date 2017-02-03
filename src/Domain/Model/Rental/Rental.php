<?php

namespace Domain\Model\Rental;

use Domain\Model\Movie\Movie;
use Domain\Service\MovieRenter\DetermineAmount;
use Domain\Service\MovieRenter\DetermineFrequentRenterPoints;

class Rental
{
    /**
     * @var Movie
     */
    private $movie;

    /**
     * @var int
     */
    private $daysRented;

    /**
     * Rental constructor.
     * @param Movie $movie
     * @param int $daysRented
     */
    private function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    /**
     * @param Movie $movie
     * @param int $daysRented
     * @return Rental
     */
    public static function instance(Movie $movie, int $daysRented) : self
    {
        return new static($movie, $daysRented);
    }

    /**
     * @return Movie
     */
    public function movie() : Movie
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function daysRented() :int
    {
        return $this->daysRented;
    }

    /**
     * @return float
     */
    public function determineAmount(): float
    {
        return DetermineAmount::instance($this->movie())->calculateByRentedDays($this->daysRented);
    }

    /**
     * @return int
     */
    public function determineFrequentRenterPoints()
    {
        return DetermineFrequentRenterPoints::instance($this->movie())
            ->calculateByRentedDays($this->daysRented);
    }

}