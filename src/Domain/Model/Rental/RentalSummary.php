<?php

namespace Domain\Model\Rental;


class RentalSummary
{

    /**
     * @var float totalAmount
     */
    private $totalAmount;

    /**
     * @var int frequenterPoints
     */
    private $frequenterPoints;

    /**
     * @return RentalSummary
     */
    public static function instance() : self
    {
        return new static();
    }

    /**
     * @return float
     */
    public function totalAmount() : float
    {
        return $this->totalAmount;
    }

    /**
     * @return int
     */
    public function frequenterPoints() : int
    {
        return $this->frequenterPoints;
    }

    /**
     * @param float $amount
     */
    public function addAmount(float $amount)
    {
        if ($amount < 0){
            throw new \InvalidArgumentException('Amount must be greater or equal than 0');
        }

        $this->totalAmount += $amount;
    }

    /**
     * @param int $frequenterPoints
     */
    public function addFrequenterPoints(int $frequenterPoints)
    {
        if ($frequenterPoints < 0)
        {
            throw new \InvalidArgumentException('Frequenter points must be greater or equal than 0');
        }

        $this->frequenterPoints += $frequenterPoints;
    }
}