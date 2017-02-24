<?php

namespace AcceptanceTests;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Domain\Model\Customer\Customer;
use Domain\Model\Movie\Movie;
use Domain\Model\Rental\RentalStatement;
use Domain\Model\Rental\Rental;

/**
 * Class RentalContext
 *
 * @package AcceptanceTests
 */
class RentalContext implements Context
{
    private $customer;

    /**
     * @var RentalStatement
     */
    private $rentalStatement;

    /**
     * @Given /^I sign up as giving my name "([^"]*)"$/
     */
    public function iSignUpAsGivingMyName(string $name)
    {
        $this->customer = Customer::create($name);
    }

    /**
     * @Given /^then I rent the following movies$/
     */
    public function thenIRentTheFollowingMovies(TableNode $table)
    {
        $this->rentalStatement = RentalStatement::instance($this->customer);
        $values = $table->getRows();
        unset($values[0]);

        foreach ($values as $value)
        {
            $movieType = $value[0];
            $movieName = $value[1];
            $rentedDays = $value[2];

            $movie = $this->getMovieByType($movieType, $movieName);

            $rental = Rental::instance($movie, $rentedDays);
            $this->rentalStatement->addRentalLines($rental);
        }

    }

    /**
     * @param string $type
     * @param string $name
     * @return Movie
     */
    private function getMovieByType(string $type, string $name) : Movie
    {
        switch ($type) {
            case 'children':
                $movie = Movie::takeChildrenMovie($name);
                break;
            case 'regular':
                $movie = Movie::takeRegularMovie($name);
                break;
            case 'new':
                $movie = Movie::takeNewReleaseMovie($name);
                break;
            default:
                throw new \InvalidArgumentException('Type not implemented');
                break;
        }

        return $movie;
    }

    /**
     * @When /^I request my rental statement$/
     */
    public function iRequestMyRentalStatement()
    {
        //Nothing to do here
    }

    /**
     * @Then /^I shoud see the next report$/
     */
    public function iShoudSeeTheNextReport(PyStringNode $string)
    {
        if ($string->getRaw() != $this->rentalStatement->print())
        {
          throw new \Exception('Invalid result');
        }
    }


}
