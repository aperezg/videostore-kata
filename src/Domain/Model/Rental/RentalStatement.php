<?php

namespace Domain\Model\Rental;


use Domain\Model\Customer\Customer;
use Domain\Service\Printer\RentalPrinter;

class RentalStatement
{
    /**
     * @var Customer
     */
    private $customer;

    /** @var Rental[] */
    private $rentalLines;

    /**
     * RentalStatement constructor.
     * @param Customer $customer
     */
    private function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @param Customer $customer
     * @return RentalStatement
     */
    public static function instance(Customer $customer): self
    {
        return new static($customer);
    }

    /**
     * @param Rental $rental
     */
    public function addRentalLines(Rental $rental)
    {
        $this->rentalLines[] = $rental;
    }

    /**
     * @return Customer
     */
    public function customer(): Customer
    {
        return $this->customer;
    }

    /**
     * @return Rental[]
     */
    public function rentalLines() : array
    {
        return $this->rentalLines;
    }

    /**
     * @return RentalSummary
     */
    public function summary() : RentalSummary
    {
        $summary = RentalSummary::instance();

        foreach ($this->rentalLines() as $rental) {
            $summary->addAmount($rental->determineAmount());
            $summary->addFrequenterPoints($rental->determineFrequentRenterPoints());
        }

        return $summary;
    }

    /**
     * @return string
     */
    public function print() : string
    {
        return RentalPrinter::instance($this)->print();
    }
}