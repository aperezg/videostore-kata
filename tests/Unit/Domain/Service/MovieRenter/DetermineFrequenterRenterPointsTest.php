<?php

namespace Unit\Domain\Service\MovieRenter;

use Domain\Model\Movie\Movie;
use Domain\Service\MovieRenter\DetermineFrequentRenterPoints;
use PHPUnit_Framework_TestCase;

class DetermineFrequenterRenterPointsTest extends PHPUnit_Framework_TestCase
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
    public function itShouldReturnAlwaysAOneFrequenterPoint()
    {
        $expectedFrequenterPoint = 1;

        $frequenterRenterPointsForRegularMovie = DetermineFrequentRenterPoints::instance($this->regularMovie)
            ->calculateByRentedDays(1);
        $frequenterRenterPointsForChildrenMovie = DetermineFrequentRenterPoints::instance($this->newReleaseMovie)
            ->calculateByRentedDays(1);
        $frequenterRenterPointsForNewReleaseMove = DetermineFrequentRenterPoints::instance($this->newReleaseMovie)
            ->calculateByRentedDays(1);

        $this->assertEquals($expectedFrequenterPoint, $frequenterRenterPointsForRegularMovie);
        $this->assertEquals($expectedFrequenterPoint, $frequenterRenterPointsForChildrenMovie);
        $this->assertEquals($expectedFrequenterPoint, $frequenterRenterPointsForNewReleaseMove);
    }

    /**
     * @test
     */
    public function itShouldReturnTwoPointsForANewReleaseWithMoreThanOneDayRented()
    {
        $expectedFrequenterPoint = 2;
        $fequenterRenterPoints = DetermineFrequentRenterPoints::instance($this->newReleaseMovie)
            ->calculateByRentedDays(2);
        $this->assertEquals($expectedFrequenterPoint, $fequenterRenterPoints);
    }
}