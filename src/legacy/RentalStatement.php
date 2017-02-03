<?php

namespace legacy;

use Domain\Model\Customer\Customer;
use Domain\Model\Rental\RentalStatement as NewRentalStatement;

/**
 * Class RentalStatement
 */
class RentalStatement
{
    /** @var  NewRentalStatement */
    private $newRentalStatement;

    /**
     * RentalStatement constructor.
     * @param $customerName
     */
    public function __construct($customerName)
    {
        $customer = Customer::create($customerName);
        $this->newRentalStatement = NewRentalStatement::instance($customer);
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental)
    {
        $this->newRentalStatement->addRentalLines($rental->generateNewRental());
    }

    /**
     * @return string
     */
    public function makeRentalStatement()
    {
        return $this->newRentalStatement->print();
    }

    /**
     * Amount owed accessor.
     * @return float
     */
    public function amountOwed() : float
    {
        return $this->newRentalStatement->summary()->totalAmount();
    }

    /**
     * Frequent renter points accessor.
     * @return int
     */
    public function frequentRenterPoints() : int
    {
        return $this->newRentalStatement->summary()->frequenterPoints();
    }
}
