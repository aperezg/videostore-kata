<?php

namespace Domain\Model\Customer;


class Customer
{
    /** @var  string */
    private $name;

    /**
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->setName($name);
    }

    /**
     * @param string $name
     * @return Customer
     */
    public static function create(string $name) : self
    {
        return new static($name);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName(string $name)
    {
        $this->name = $name;
    }
}