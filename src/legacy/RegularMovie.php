<?php

namespace legacy;

use Domain\Model\Movie\Movie as NewMovie;


/**
 * Class RegularMovie
 */
class RegularMovie extends Movie
{
    /**
     * RegularMovie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        parent::__construct($title);
        $this->setMovie(NewMovie::takeRegularMovie($title));
    }
}
