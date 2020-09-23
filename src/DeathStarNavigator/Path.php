<?php

namespace DeathStarNavigator;

class Path
{
    private array $moves;

    public function __construct(array $moves)
    {
        $this->moves = $moves;
    }

    public function getMoves()
    {
        return $this->moves;
    }
}
