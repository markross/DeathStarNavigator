<?php

namespace DeathStarNavigator;

class Droid implements Sendable
{
    /**
     * @var NavigationInterface
     */
    private NavigationInterface $navigator;
    /**
     * @var Path
     */
    private Path $path;

    public function __construct(Path $path, NavigationInterface $navigator)
    {
        $this->navigator = $navigator;
        $this->path = $path;
    }

    public function send() : CrashReportInterface
    {
        return $this->navigator->navigate($this->path);
    }
}
