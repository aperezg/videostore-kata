<?php

namespace legacy;

use Domain\Model\Movie\Movie as NewMovie;

/**
 * Class NewReleaseMovie
 */
class NewReleaseMovie extends Movie
{
    /**
     * NewReleaseMovie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        parent::__construct($title);
        $this->setMovie(NewMovie::takeNewReleaseMovie($title));
    }
}
