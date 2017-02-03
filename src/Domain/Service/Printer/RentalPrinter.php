<?php
/**
 * Created by PhpStorm.
 * User: aperez
 * Date: 2/2/17
 * Time: 23:32
 */

namespace Domain\Service\Printer;


use Domain\Model\Rental\Rental;
use Domain\Model\Rental\RentalStatement;

class RentalPrinter
{

    private function __construct(RentalStatement $rentalStatement)
    {
        $this->rentalStatement = $rentalStatement;
    }

    /**
     * @param RentalStatement $rentalStatement
     * @return RentalPrinter
     */
    public static function instance(RentalStatement $rentalStatement): self
    {
        return new static($rentalStatement);
    }

    public function print()
    {
        return $this->formatHeader() .
            $this->formatRentalLines() .
            $this->formatSummary();
    }

    /**
     * @return string
     */
    private function formatRentalLines(): string
    {
        $rentalLines = "";

        foreach ($this->rentalStatement->rentalLines() as $rental) {
            $rentalLines .= $this->formatRentalLine($rental);
        }

        return $rentalLines;
    }

    /**
     * @return string
     */
    private function formatHeader(): string
    {
        return "Rental Record for " . $this->rentalStatement->customer()->name() . "\n";
    }

    /**
     * @param Rental $rental
     * @return string
     */
    private function formatRentalLine(Rental $rental): string
    {
        return "\t" . $rental->movie()->title() . "\t" .
            number_format($rental->determineAmount(), 1) . "\n";
    }

    /**
     * @return string
     */
    private function formatSummary(): string
    {
        $summary = $this->rentalStatement->summary();

        return "You owed " . number_format($summary->totalAmount(), 1) . "\n" .
            "You earned " . $summary->frequenterPoints() . " frequent renter points\n";
    }
}