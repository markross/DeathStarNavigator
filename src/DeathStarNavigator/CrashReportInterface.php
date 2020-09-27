<?php


namespace DeathStarNavigator;

interface CrashReportInterface
{
    /**
     * @return array<int>
     */
    public function getCrashLocation() : array;

    /**
     * @return array<string>
     */
    public function getMap() : array;

    /**
     * @return bool
     */
    public function isLost() : bool;

    /**
     * @return bool
     */
    public function hasCrashed() : bool;
}
