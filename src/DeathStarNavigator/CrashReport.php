<?php


namespace DeathStarNavigator;

class CrashReport implements CrashReportInterface
{
    /**
     * @var array Coordinates of the crash location
     */
    private array $crashLocation;
    /**
     * @var array The map of the last line of crash location
     */
    private array $map;
    /**
     * @var bool If a crash is being reported
     */
    private bool $hasCrashed;

    /**
     * CrashReport constructor.
     * @param bool $hasCrashed
     * @param array $crashLocation
     * @param array $map
     */
    public function __construct(bool $hasCrashed, array $crashLocation = [], array $map = [])
    {
        $this->hasCrashed = $hasCrashed;
        $this->crashLocation = $crashLocation;
        $this->map = $map;
    }

    /**
     * @return bool
     */
    public function hasCrashed() : bool
    {
        return $this->hasCrashed;
    }

    /**
     * @return array
     */
    public function getCrashLocation() : array
    {
        return $this->crashLocation;
    }

    /**
     * @return array
     */
    public function getMap() : array
    {
        return $this->map;
    }
}
