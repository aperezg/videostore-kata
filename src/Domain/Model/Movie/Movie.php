<?php

namespace Domain\Model\Movie;


class Movie
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var MovieType
     */
    private $movieType;

    private function __construct(string $title, MovieType $movieType)
    {
        $this->title = $title;
        $this->movieType = $movieType;
    }

    /**
     * @param string $title
     * @return Movie
     */
    public static function takeRegularMovie(string $title) : self
    {
        return new static($title, MovieType::regularMovieType());
    }

    /**
     * @param string $title
     * @return Movie
     */
    public static function takeChildrenMovie(string $title) : self
    {
        return new static($title, MovieType::childrenMovieType());
    }

    /**
     * @param string $title
     * @return Movie
     */
    public static function takeNewReleaseMovie(string $title) : self
    {
        return new static($title, MovieType::newReleaseMovieType());
    }

    /**
     * @return MovieType
     */
    public function movieType(): MovieType
    {
        return $this->movieType;
    }

}