<?php

namespace Unit\Domain\Service\Printer;


use Domain\Model\Customer\Customer;
use Domain\Model\Movie\Movie;
use Domain\Model\Rental\Rental;
use Domain\Model\Rental\RentalStatement;
use Domain\Service\Printer\RentalPrinter;
use PHPUnit_Framework_TestCase;

class RentalPrinterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RentalStatement $rentalSummary
     */
    private $rentalStatement;

    const RENTED_DAYS = 5;
    const CHILDREN_MOVIE_TITLE = 'Moana';
    const CUSTOMER_NAME = 'Makhan';

    /**
     * Test set up.
     */
    protected function setUp()
    {
        $customer = Customer::create(self::CUSTOMER_NAME);
        $movie = Movie::takeChildrenMovie(self::CHILDREN_MOVIE_TITLE);
        $rental = Rental::instance($movie, self::RENTED_DAYS);

        $this->rentalStatement = RentalStatement::instance($customer);
        $this->rentalStatement->addRentalLines($rental);
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
    public function itShouldReturnAnExpectedRentalStatementFormatted()
    {
        $expectedRentalStatementString = "Rental Record for Makhan\n" .
            "\tMoana\t4.5\n" .
            "You owed 4.5\n" .
            "You earned 1 frequent renter points\n";

        $ticket = RentalPrinter::instance($this->rentalStatement)->print();

        $this->assertEquals($expectedRentalStatementString, $ticket);
    }


}