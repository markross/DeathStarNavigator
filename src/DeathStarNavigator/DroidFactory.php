<?php


namespace DeathStarNavigator;

class DroidFactory
{
    public function create(Path $path) : Sendable
    {
        $navigator = new NavigationService();
        return new Droid($path, $navigator);
    }
}
