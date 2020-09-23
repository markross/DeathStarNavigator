<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\Droid;
use PhpSpec\ObjectBehavior;

class DroidSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(0, 4);
    }

    function it_has_a_position()
    {
        $this->getPosition()->shouldBe([0, 4]);
    }

    function it_can_be_moved_forward()
    {
        $this->move(Droid::DIR_FORWARD);
        $this->getPosition()->shouldBe([1, 4]);
    }

    function it_can_move_left()
    {
        $this->move(Droid::DIR_LEFT);
        $this->getPosition()->shouldBe([0, 3]);
    }

    function it_can_move_right()
    {
        $this->move(Droid::DIR_RIGHT);
        $this->getPosition()->shouldBe([0, 5]);
    }

    function it_can_make_multiple_moves()
    {
        $this->move(Droid::DIR_RIGHT); // [0, 5]
        $this->move(Droid::DIR_FORWARD); // [1, 5]
        $this->move(Droid::DIR_RIGHT); // [1, 6]
        $this->move(Droid::DIR_FORWARD); // [2, 6]
        $this->move(Droid::DIR_FORWARD); // [3 ,6]
        $this->getPosition()->shouldBe([3, 6]);
    }

    function it_remembers_its_moves()
    {
        $this->move(Droid::DIR_RIGHT);
        $this->move(Droid::DIR_LEFT);
        $this->move(Droid::DIR_FORWARD);
        $this->getMoves()->shouldBe('rlf');
    }

}
