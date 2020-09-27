<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\CrashReportInterface;
use DeathStarNavigator\Droid;
use DeathStarNavigator\DroidFactory;
use DeathStarNavigator\Path;
use PhpSpec\ObjectBehavior;

class PathFinderSpec extends ObjectBehavior
{
    function let(DroidFactory $droidFactory, Path $path)
    {
        $this->beConstructedWith($droidFactory, $path);
    }

    function it_checks_a_path(DroidFactory $droidFactory, Path $path, Droid $droid, CrashReportInterface $crashReport)
    {
        $droidFactory->create($path)->willReturn($droid);
        $droid->send()->willReturn($crashReport);
        $crashReport->getMap()->willReturn(
            ['#','#','#',' ','#','#','#','#','#'],
            ['#','#',' ','#','#','#','#','#','#'],
            ['#','#','#','#','#','#',' ',' ','#'],
        );
        $crashReport->getCrashLocation()->willReturn([15, 4], [18,4], [50, 2], []);
        $this->run($path);
        $path->addMove(['l'], 15)->shouldHaveBeenCalled();
        $path->addMove(['l','l'], 18)->shouldHaveBeenCalled();
        $path->addMove(['r','r','r','r'], 50)->shouldHaveBeenCalled();
    }
}
