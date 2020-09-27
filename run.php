<?php

use DeathStarNavigator\Config;
use DeathStarNavigator\DroidFactory;
use DeathStarNavigator\PathFinder;

require './vendor/autoload.php';
$config = Config::get();
$pathFinder = new PathFinder(new DroidFactory(), $config->getTunnelLength());
try {
    $path = $pathFinder->run();
    echo "\n\nPath found at {$path}\n";
} catch (Exception $e) {
    echo "Something went wrong. Error was: \n\n{$e->getMessage()}\n";
}
