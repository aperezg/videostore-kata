<?php

namespace legacy;

use Domain\Model\Rental\Rental as NewRental;

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
     * @return NewRental
     */
    public function generateNewRental()
    {
        return NewRental::instance($this->legacyMovie->movie(), $this->daysRented);
    }
}
