<?php

namespace legacy;

/**
 * Class RentalStatement
 */
class RentalStatement
{
    /** @var  string */
    private $name;
    /** @var  float */
    private $amount;
    /** @var  int */
    private $frequentRenterPoints;
    /** @var  array */
    private $rentals;

    /**
     * RentalStatement constructor.
     * @param $customerName
     */
    public function __construct($customerName)
    {
        $this->name = $customerName;
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;

        $this->amount += $rental->determineAmount();
        $this->frequentRenterPoints += $rental->determineFrequentRenterPoints();
    }

    /**
     * @return string
     */
    public function makeRentalStatement()
    {
        return $this->makeHeader() . $this->makeRentalLines() . $this->makeSummary();
    }

    /**
     * @return string
     */
    private function makeHeader() : string
    {
        return "Rental Record for " . $this->name() . "\n";
    }

    /**
     * @return string
     */
    private function makeRentalLines() : string
    {
        $rentalLines = "";

        foreach($this->rentals as $rental) {
            $rentalLines .= $this->formatRentalLine($rental);
        }

        return $rentalLines;
    }

    /**
     * @param Rental $rental
     * @return string
     */
    private function formatRentalLine(Rental $rental) : string
    {
        return "\t" . $rental->title() . "\t" . number_format($rental->determineAmount(),1) . "\n";
    }

    /**
     * @return string
     */
    private function makeSummary() : string
    {
        return "You owed " . $this->amount . "\n" .
               "You earned " . $this->frequentRenterPoints . " frequent renter points\n";
    }

    /**
     * Name accessor.
     * @return string
     */
    public function name() : string
    {
        return $this->name;
    }

    /**
     * Amount owed accessor.
     * @return float
     */
    public function amountOwed() : float
    {
        return $this->amount;
    }

    /**
     * Frequent renter points accessor.
     * @return int
     */
    public function frequentRenterPoints() : int
    {
        return $this->frequentRenterPoints;
    }
}
