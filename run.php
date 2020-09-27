<?php

use DeathStarNavigator\DroidFactory;
use DeathStarNavigator\PathFinder;

require './vendor/autoload.php';
$pathFinder = new PathFinder(new DroidFactory(), 500);
$path = $pathFinder->run();
echo "Path is {$path}";