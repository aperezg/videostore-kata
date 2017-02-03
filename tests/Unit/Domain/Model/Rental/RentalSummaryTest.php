<?php

namespace Unit\Domain\Model\Rental;

use Domain\Model\Rental\RentalSummary;
use PHPUnit_Framework_TestCase;

class RentalSummaryTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var RentalSummary $rentalSummary
     */
    private $rentalSummary;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->rentalSummary = RentalSummary::instance();
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->rentalSummary = null;
    }

    /**
     * @test
     */
    public function itShouldThrowAnInvalidArgumentExceptionWithAmountLessThan0()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->rentalSummary->addAmount(-5);
    }

    /**
     * @test
     */
    public function itShouldAddAnAmountIntoTotalAmountOfRentalSummary()
    {
        $amount = 5;
        $this->rentalSummary->addAmount($amount);
        $this->assertEquals($amount, $this->rentalSummary->totalAmount());
    }

    /**
     * @test
     */
    public function itShouldATotalAmountOfAddedAmountIntoRentalSummary()
    {
        $expectedResult = 15;
        $this->rentalSummary->addAmount(3);
        $this->rentalSummary->addAmount(7);
        $this->rentalSummary->addAmount(5);

        $this->assertEquals($expectedResult, $this->rentalSummary->totalAmount());
    }

    /**
     * @test
     */
    public function itShouldThrowAnInvalidArgumentExceptionWithFrequenterPointsLessThan0()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->rentalSummary->addFrequenterPoints(-3);
    }

    /**
     * @test
     */
    public function itShouldAddAFrequenterPointIntoTotalAmountOfRentalSummary()
    {
        $points = 5;
        $this->rentalSummary->addFrequenterPoints($points);
        $this->assertEquals($points, $this->rentalSummary->frequenterPoints());
    }

    /**
     * @test
     */
    public function itShouldATotalFrequenterPointsOfAddedFrequenterPointsIntoRentalSummary()
    {
        $expectedResult = 6;
        $this->rentalSummary->addFrequenterPoints(2);
        $this->rentalSummary->addFrequenterPoints(1);
        $this->rentalSummary->addFrequenterPoints(3);

        $this->assertEquals($expectedResult, $this->rentalSummary->frequenterPoints());
    }
}