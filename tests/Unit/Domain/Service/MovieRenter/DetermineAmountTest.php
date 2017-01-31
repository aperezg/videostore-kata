<?php

namespace Unit\Domain\Service\MovieRenter;

use Domain\Model\Movie\Movie;
use Domain\Service\MovieRenter\DetermineAmount;
use PHPUnit_Framework_TestCase;

class DetermineAmountTest extends PHPUnit_Framework_TestCase
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
        $this->newReleaseMovie = Movie::takeNewReleaseMovie('Star Wars: Rogue One');
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
        $amount = DetermineAmount::instance($this->regularMovie)->calculateByRentedDays(2);
        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForRegularMovieWithMoreThan2DaysRented()
    {
        $expectedAmount = 3.5;
        $amount = DetermineAmount::instance($this->regularMovie)->calculateByRentedDays(3);
        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForChildrenMovie()
    {
        $expectedAmount = 1.5;
        $amount = DetermineAmount::instance($this->childrenMovie)->calculateByRentedDays(3);
        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForChildrenMovieWithMoreThan3DaysRented()
    {
        $expectedAmount = 1.5;
        $amount = DetermineAmount::instance($this->childrenMovie)->calculateByRentedDays(3);
        $this->assertEquals($expectedAmount, $amount);
    }

    /**
     * @test
     */
    public function itShouldReturnACorrectAmountForNewReleaseMovie()
    {
        $expectedAmount = 9;
        $amount = DetermineAmount::instance($this->newReleaseMovie)->calculateByRentedDays(3);
        $this->assertEquals($expectedAmount, $amount);
    }
}