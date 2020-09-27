<?php


namespace DeathStarNavigator;

class DroidFactory
{
    public function create(Path $path) : Sendable
    {
        $navigator = new NavigationService(null, null, new Config('../../config.json'));
        return new Droid($path, $navigator);
    }
}
