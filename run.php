<?php

use DeathStarNavigator\DroidFactory;
use DeathStarNavigator\PathFinder;

require './vendor/autoload.php';
$config = \DeathStarNavigator\Config::get();
$pathFinder = new PathFinder(new DroidFactory(), $config->getTunnelLength());
try {
    $path = $pathFinder->run();
    echo "Path is {$path}";
} catch (Exception $e) {
    echo "Something went wrong. Error was: \n\n{$e->getMessage()}\n";
}
