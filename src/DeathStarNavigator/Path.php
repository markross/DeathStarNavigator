<?php

namespace DeathStarNavigator;

class Path
{
    const DIRECTION_LEFT = 'l';
    const DIRECTION_RIGHT = 'r';
    const DIRECTION_FORWARD = 'f';

    /**
     * @var array A list of moves
     */
    private array $moves;

    /**
     *
     * Path Constructor - takes an array of moves and groups them by X position. Left or Right moves maintain the
     * x position. For example:
     *
     * 0 => 'f',
     * 1 => 'f',
     * 2 => 'f','l',
     * 3 => 'f'
     * 4 => 'f','r','r'
     * 5 => 'f'
     *
     * @param array $moves
     */
    public function __construct(array $moves)
    {
        $movesGroupedByXPos = [];
        foreach ($moves as $move) {
            if ($move === self::DIRECTION_FORWARD) {
                $movesGroupedByXPos[] = [$move];
            } else {
                $movesGroupedByXPos[count($movesGroupedByXPos) - 1 ][] = $move;
            }
        }

        $this->moves = $movesGroupedByXPos;
    }

    /**
     * @return array
     */
    public function getMoves() : array
    {
        return $this->moves;
    }

    /**
     * Add a left or right move to the move list
     *
     * @param array $moves
     * @param int $position
     */
    public function addMove(array $moves, int $position) : void
    {
        // check for left of right moves only
        // @TODO - handle forward?
        $this->moves[$position - 2] = [...$this->moves[$position - 2], ...$moves];
    }

    public function __toString() : string
    {
        return implode('', array_reduce($this->moves, 'array_merge', []));
    }
}
