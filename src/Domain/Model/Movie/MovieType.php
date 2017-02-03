<?php

namespace Domain\Model\Movie;


class MovieType
{
    const REGULAR_TYPE = 0;
    const CHILDREN_TYPE = 1;
    const NEW_RELEASE_TYPE = 2;


    /** @var int */
    private $type;

    /**
     * @param int $type
     */
    private function __construct(int $type)
    {
        $this->setType($type);
    }

    /**
     * @return MovieType
     */
    public static function regularMovieType() : self
    {
        return new static(self::REGULAR_TYPE);
    }

    /**
     * @return MovieType
     */
    public static function childrenMovieType() : self
    {
        return new static(self::CHILDREN_TYPE);
    }

    /**
     * @return MovieType
     */
    public static function newReleaseMovieType() : self
    {
        return new static(self::NEW_RELEASE_TYPE);
    }

    /**
     * @return int
     */
    public function type() : int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    private function setType(int $type)
    {
        $this->type = $type;
    }

}