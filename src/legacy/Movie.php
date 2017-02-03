<?php

namespace legacy;

use Domain\Model\Movie\Movie as NewMovie;

/**
 * Class Movie
 */
abstract class Movie
{
    /** @var  string */
    private $title;

    /** @var  NewMovie */
    private $movie;

    /**
     * Movie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    public function movie() : NewMovie
    {
        return $this->movie;
    }

    protected function setMovie(NewMovie $movie)
    {
        $this->movie = $movie;
    }

    /**
     * Title accessor.
     * @return string
     */
    public function title() : string
    {
        return $this->title;
    }
}
