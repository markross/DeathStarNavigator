<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\CrashReportInterface;
use DeathStarNavigator\Droid;
use DeathStarNavigator\Path;
use DeathStarNavigator\NavigationInterface;
use PhpSpec\ObjectBehavior;

class DroidSpec extends ObjectBehavior
{
    function let(Path $path, NavigationInterface $pathCheck, CrashReportInterface $crashReport)
    {
        $pathCheck->navigate($path)->willReturn($crashReport);
        $this->beConstructedWith($path, $pathCheck);
    }

    function it_can_be_sent_along_a_path(NavigationInterface $pathCheck, Path $path)
    {
        $this->send();
        $pathCheck->navigate($path)->shouldHaveBeenCalled();
    }

}
