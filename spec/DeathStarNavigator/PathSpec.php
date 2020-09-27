<?php

namespace spec\DeathStarNavigator;

use PhpSpec\ObjectBehavior;

class PathSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['f','f','l','f','f','r']);
    }

    function it_stores_a_list_of_moves()
    {
        $expected = [
            0 => ['f'],
            1 => ['f','l'],
            2 => ['f'],
            3 => ['f', 'r'],
        ];
        $this->getMoves()->shouldBeLike($expected);
    }

    function it_can_insert_a_move_at_specified_position()
    {
        $this->addMove(['l','l'], 2);
        $expected = [
            0 => ['f', 'l', 'l'],
            1 => ['f','l'],
            2 => ['f'],
            3 => ['f', 'r'],
        ];
        $this->getMoves()->shouldBeLike($expected);
    }

    function it_throws_exception_if_invalid_move_added()
    {
        $this->shouldThrow('\InvalidArgumentException')->duringAddMove(['c'], 1);
    }

    function it_can_be_cast_to_a_string()
    {
        $this->__toString()->shouldBe('fflffr');
    }

}
