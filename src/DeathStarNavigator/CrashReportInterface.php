<?php


namespace DeathStarNavigator;

interface CrashReportInterface
{
    public function getCrashLocation() : array;
    public function getMap() : array;
}
