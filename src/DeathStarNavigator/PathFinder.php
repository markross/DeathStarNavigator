<?php

namespace DeathStarNavigator;

/**
 *
 * Pathfinder continuously sends out Droids and receives and analyses crash reports until it finds the end
 *
 * Class PathFinder
 * @package DeathStarNavigator
 */
class PathFinder
{
    const DROID_LOST_MESSAGE = 'Droid has been lost. Did you configure the correct tunnel length?';
    /**
     * @var DroidFactory
     */
    private DroidFactory $droidFactory;
    /**
     * @var Path
     */
    private Path $startingPath;

    public function __construct(DroidFactory $droidFactory, int $tunnelLength)
    {
        $startingPath = new Path(array_fill(0, $tunnelLength, 'f'));
        $this->droidFactory = $droidFactory;
        $this->startingPath = $startingPath;
    }

    public function run(Path $path = null) : Path
    {
        if (is_null($path)) {
            $path = $this->startingPath;
        }
        $droid = $this->droidFactory->create($path);
        $crashReport = $droid->send();
        $crashLocation = $crashReport->getCrashLocation();

        if ($crashReport->isLost()) {
            throw new DroidLostException(self::DROID_LOST_MESSAGE);
        }

        if ($crashReport->hasCrashed()) {
            echo "\nCrashed at $crashLocation[0], $crashLocation[1]. Sending new Droid";
            $crashX = $crashLocation[0];
            $map = $crashReport->getMap();
            $nextMove = $this->findMovesToNearestHole($map, $crashLocation);
            $path->addMove($nextMove, $crashX);
            $this->run($path);
        }

        return $path;
    }

    /**
     * Find the nearest hole to the left or right. Returns list of moves to reach hole
     *
     * @param array $mapLine
     * @param array $crashLocation
     * @return array The list of moves to get to the hole
     */
    public function findMovesToNearestHole(array $mapLine, array $crashLocation) : array
    {
        $distanceToLeft = $this->findClosestHoleToLeft($crashLocation[1], $mapLine);
        $distanceToRight = $this->findClosestHoleToRight($crashLocation[1], $mapLine);

        if ($distanceToLeft) {
            return array_fill(0, $distanceToLeft, 'l');
        } elseif ($distanceToRight) {
            return array_fill(0, $distanceToRight, 'r');
        }

        return [];
    }

    /**
     * Search to the left for the hole
     *
     * @param int $crashYLocation The Y coordinate of the crash location
     * @param array $mapLine
     * @return int|bool The number of moves or false if no hole found
     */
    private function findClosestHoleToLeft(int $crashYLocation, array $mapLine)
    {
        $distanceToLeft = 0;
        $location = $crashYLocation;

        while ($location >= 0 && $mapLine[$location] !== ' ') {
            $distanceToLeft++;
            $location--;
        }
        return $location === -1 ? false : $distanceToLeft;
    }

    /**
     * Search to the right for the hole
     *
     * @param int $crashYLocation The Y coordinate of the crash location
     * @param array $mapLine
     * @return int|bool The number of moves or false if no hole found
     */
    private function findClosestHoleToRight(int $crashYLocation, array $mapLine)
    {
        $distanceToRight = 0;
        $location = $crashYLocation;

        while ($location < 9 && $mapLine[$location] != ' ') {
            $distanceToRight++;
            $location++;
        }

        return $location === 9 ? false : $distanceToRight;
    }
}
