<?php


namespace DeathStarNavigator;

class CrashReport implements CrashReportInterface
{
    /**
     * @var array<int> Coordinates of the crash location
     */
    private array $crashLocation;
    /**
     * @var array<string> The map of the last line of crash location
     */
    private array $map;
    /**
     * @var bool If a crash is being reported
     */
    private bool $hasCrashed = false;
    /**
     * @var bool If the Droid is lost
     */
    private bool $isLost;

    /**
     * CrashReport constructor.
     * @param bool $hasCrashed
     * @param array<int> $crashLocation
     * @param array<string> $map
     * @param bool $isLost
     */
    public function __construct(bool $hasCrashed, array $crashLocation = [], array $map = [], bool $isLost = false)
    {
        $this->hasCrashed = $hasCrashed;
        $this->crashLocation = $crashLocation;
        $this->map = $map;
        $this->isLost = $isLost;
    }

    /**
     * @return bool
     */
    public function hasCrashed() : bool
    {
        return $this->hasCrashed;
    }

    /**
     * @return array<int>
     */
    public function getCrashLocation() : array
    {
        return $this->crashLocation;
    }

    /**
     * @return array<string>
     */
    public function getMap() : array
    {
        return $this->map;
    }

    public function isLost() : bool
    {
        return $this->isLost;
    }
}
