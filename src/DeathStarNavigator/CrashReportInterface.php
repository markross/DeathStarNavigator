<?php


namespace DeathStarNavigator;

interface CrashReportInterface
{
    public function getCrashLocation() : array;
    public function getMap() : array;
    public function isLost() : bool;
    public function hasCrashed() : bool;
}
