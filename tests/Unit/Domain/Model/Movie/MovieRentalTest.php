<?php

namespace tests\Unit\Domain\Model\Movie;

use Domain\Model\Movie\Movie;
use Domain\Model\Movie\MovieRental;
use PHPUnit_Framework_TestCase;

class MovieRentalTest extends PHPUnit_Framework_TestCase
{

    private $regularMovie;
    private $childrenMovie;
    private $newReleaseMovie;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->regularMovie = Movie::takeRegularMovie('Deadpool');
        $this->childrenMovie = Movie::takeChildrenMovie('Aladdin');
        $this->newReleaseMovie = Movie::takeNewReleaseMove('Star Wars: Rogue One');
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->regularMovie = null;
        $this->childrenMovie = null;
        $this->newReleaseMovie = null;
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForRegularMovie()
    {
        $expectedAmount = 2;

        $rental = MovieRental::instance($this->regularMovie);
        $amount = $rental->determineAmount(2);

        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForRegularMovieWithMoreThan2DaysRented()
    {
        $expectedAmount = 3.5;

        $rental = MovieRental::instance($this->regularMovie);
        $amount = $rental->determineAmount(3);

        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForChildrenMovie()
    {
        $expectedAmount = 1.5;

        $rental = MovieRental::instance($this->childrenMovie);
        $amount = $rental->determineAmount(3);

        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForChildrenMovieWithMoreThan3DaysRented()
    {
        $expectedAmount = 1.5;

        $rental = MovieRental::instance($this->childrenMovie);
        $amount = $rental->determineAmount(3);

        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForNewReleaseMovie()
    {
        $expectedAmount = 9;

        $rental = MovieRental::instance($this->newReleaseMovie);
        $amount = $rental->determineAmount(3);

        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnAlwaysAOneFrequenterPoint()
    {
        $expectedFrequenterPoint = 1;

        $rentalRegular = MovieRental::instance($this->regularMovie);
        $rentalChildren = MovieRental::instance($this->newReleaseMovie);
        $rentalNewRelease = MovieRental::instance($this->newReleaseMovie);

        $this->assertEquals($expectedFrequenterPoint, $rentalRegular->determineFrequentRenterPoints(1));
        $this->assertEquals($expectedFrequenterPoint, $rentalChildren->determineFrequentRenterPoints(1));
        $this->assertEquals($expectedFrequenterPoint, $rentalNewRelease->determineFrequentRenterPoints(1));
    }

    /**
     * @test
     */
    public function itShouldReturnTwoPointsForANewReleaseWithMoreThanOneDayRented()
    {
        $expectedFrequenterPoint = 2;

        $rental = MovieRental::instance($this->newReleaseMovie);
        $this->assertEquals($expectedFrequenterPoint, $rental->determineFrequentRenterPoints(2));
    }
}