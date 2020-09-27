<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\CrashReportInterface;
use DeathStarNavigator\Droid;
use DeathStarNavigator\DroidFactory;
use DeathStarNavigator\DroidLostException;
use DeathStarNavigator\Path;
use PhpSpec\ObjectBehavior;

class PathFinderSpec extends ObjectBehavior
{
    function let(DroidFactory $droidFactory)
    {
        $this->beConstructedWith($droidFactory, 10);
    }

    function it_checks_a_path(DroidFactory $droidFactory, Path $path, Droid $droid, CrashReportInterface $crashReport)
    {
        $droidFactory->create($path)->willReturn($droid);
        $droid->send()->willReturn($crashReport);
        $crashReport->getCrashLocation()->willReturn([15, 4], [18,4], [50, 2], []);
        $crashReport->hasCrashed()->willReturn(true, true, true, false);
        $crashReport->isLost()->willReturn(false);
        $crashReport->getMap()->willReturn(
            ['#','#','#',' ','#','#','#','#','#'],
            ['#','#',' ','#','#','#','#','#','#'],
            ['#','#','#','#','#','#',' ',' ','#'],
        );

        $this->run($path);

        $path->addMove(['l'], 15)->shouldHaveBeenCalled();
        $path->addMove(['l','l'], 18)->shouldHaveBeenCalled();
        $path->addMove(['r','r','r','r'], 50)->shouldHaveBeenCalled();
    }

    function it_throws_if_droid_is_lost(DroidFactory $droidFactory, Path $path, Droid $droid, CrashReportInterface $crashReport)
    {
        $droidFactory->create($path)->willReturn($droid);
        $droid->send()->willReturn($crashReport);
        $crashReport->hasCrashed()->willReturn(true, true, true, false);
        $crashReport->isLost()->willReturn(true);
        $crashReport->getCrashLocation()->willReturn([]);

        $this->shouldThrow(new DroidLostException('Droid has been lost. Did you configure the correct tunnel length?'))
            ->duringRun($path);

    }
}
