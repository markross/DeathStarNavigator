<?php


namespace DeathStarNavigator;

interface NavigationInterface
{
    /**
     * @param Path $path
     * @return CrashReportInterface
     */
    public function navigate(Path $path) : CrashReportInterface;
}
