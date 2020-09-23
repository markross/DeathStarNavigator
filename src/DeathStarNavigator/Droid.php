<?php

namespace DeathStarNavigator;

use InvalidArgumentException;

class Droid
{
    const DIR_FORWARD = 'f';
    const DIR_LEFT = 'l';
    const DIR_RIGHT = 'r';

    /**
     * @var int X position
     */
    private int $xPos;
    /**
     * @var int Y Position
     */
    private int $yPos;

    private array $moves = [];
    /**
     * Droid constructor.
     * @param int $xPos
     * @param int $yPos
     */
    public function __construct(int $xPos, int $yPos)
    {
        $this->xPos = $xPos;
        $this->yPos = $yPos;
    }

    /**
     * @return array The current coordinates of the Droid
     */
    public function getPosition() : array
    {
        return [$this->xPos, $this->yPos];
    }

    /**
     * @param string $direction Move the droid one place in the specified direction
     */
    public function move(string $direction) : array
    {
        switch ($direction) {
            case self::DIR_FORWARD:
                $this->xPos++;
                break;
            case self::DIR_RIGHT:
                $this->yPos++;
                break;
            case self::DIR_LEFT:
                $this->yPos--;
                break;
            default:
                throw new InvalidArgumentException('Invalid direction specified');
        }

        $this->moves[] = $direction;
        return [$this->xPos, $this->yPos];
    }

    public function getMoves()
    {
        return implode("", $this->moves);
    }
}
