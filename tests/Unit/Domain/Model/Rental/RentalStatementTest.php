<?php

namespace Unit\Domain\Model\Rental;

use Domain\Model\Customer\Customer;
use Domain\Model\Movie\Movie;
use Domain\Model\Rental\Rental;
use Domain\Model\Rental\RentalStatement;
use Domain\Model\Rental\RentalSummary;
use PHPUnit_Framework_TestCase;

class RentalStatementTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RentalStatement $rentalSummary
     */
    private $rentalStatement;

    const CUSTOMER_NAME = 'Makhan';
    const MOVIE_TITLE = 'Power Rangers';
    const RENTED_DAYS = 3;

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $this->rentalStatement = RentalStatement::instance(Customer::create(self::CUSTOMER_NAME));
    }

    /**
     * Test tear down objects.
     */
    protected function tearDown()
    {
        $this->rentalStatement = null;
    }

    /**
     * @test
     */
    public function itShouldAddARentalIntoRentalStatement()
    {
        $expectedRental = Rental::instance(Movie::takeNewReleaseMovie(self::MOVIE_TITLE), self::RENTED_DAYS);
        $this->rentalStatement->addRentalLines($expectedRental);
        $firstRental = $this->rentalStatement->rentalLines()[0];
        $this->assertEquals($expectedRental, $firstRental);
    }

    /**
     * @test
     */
    public function itShouldReturnAnInstanceOfRentalSummary()
    {
        $rental = Rental::instance(Movie::takeNewReleaseMovie(self::MOVIE_TITLE), self::RENTED_DAYS);
        $this->rentalStatement->addRentalLines($rental);

        $summary = $this->rentalStatement->summary();

        $this->assertInstanceOf(RentalSummary::class, $summary);
    }
}