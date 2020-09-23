<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\Path;
use PhpSpec\ObjectBehavior;

class PathSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['f','f','l','r']);
    }

    function it_stores_a_list_of_moves()
    {
        $this->getMoves()->shouldBe(['f','f','l','r']);
    }
}
