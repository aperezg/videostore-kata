<?php

namespace legacy;

use Domain\Service\MovieRenter\DetermineAmount;
use Domain\Service\MovieRenter\DetermineFrequentRenterPoints;

/**
 * Class Rental
 */
class Rental
{
    /** @var  Movie */
    private $legacyMovie;

    /** @var  int */
    private $daysRented;

    /**
     * Rental constructor.
     * @param Movie $legacyMovie
     * @param int $daysRented
     */
    public function __construct(Movie $legacyMovie, int $daysRented)
    {
        $this->legacyMovie = $legacyMovie;
        $this->daysRented = $daysRented;
    }

    /**
     * Movie's title accessor.
     * @return string
     */
    public function title(): string
    {
        return $this->legacyMovie->movie()->title();
    }

    /**
     * Movie's amount accessor.
     * @return float
     */
    public function determineAmount(): float
    {
        return DetermineAmount::instance($this->legacyMovie->movie())->calculateByRentedDays($this->daysRented);
    }

    public function determineFrequentRenterPoints()
    {
        return DetermineFrequentRenterPoints::instance($this->legacyMovie->movie())
            ->calculateByRentedDays($this->daysRented);
    }
}
