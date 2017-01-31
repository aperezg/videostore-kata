<?php

namespace legacy;

use Domain\Model\Movie\Movie as NewMovie;

/**
 * Class ChildrensMovie
 */
class ChildrensMovie extends Movie
{
    /**
     * ChildrensMovie constructor.
     * @param $title
     */
    public function __construct($title)
    {
        parent::__construct($title);
        $this->setMovie(NewMovie::takeChildrenMovie($title));
    }
}
