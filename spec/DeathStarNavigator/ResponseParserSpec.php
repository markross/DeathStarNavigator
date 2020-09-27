<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\ResponseParser;
use Nyholm\Psr7\Response;
use PhpSpec\ObjectBehavior;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class ResponseParserSpec extends ObjectBehavior
{
    function let(ResponseInterface $response)
    {
        $this->beConstructedWith($response);
    }

    function it_gets_the_crashed_status(ResponseInterface $response, StreamInterface $stream)
    {
        $response->getStatusCode()->willReturn(417);
        $response->getBody()->willReturn($stream);
        $stream->getContents()->willReturn(
            <<<EOF
{"message":"Crashed at position 12,4.","map":""}
EOF);
        $this->beConstructedWith($response);

        $this->hasCrashed()->shouldBe(true);
    }

    function it_gets_the_crash_location(ResponseInterface $response, StreamInterface $stream)
    {
        $response->getStatusCode()->willReturn(417);
        $response->getBody()->willReturn($stream);
        $stream->getContents()->willReturn(
<<<EOF
{"message":"Crashed at position 12,4.","map":""}
EOF
        );

        $this->hasCrashed()->shouldBe(true);
        $this->getCrashLocation()->shouldBe([12,4]);
    }

    function it_gets_the_map_at_the_crash_location(ResponseInterface $response, StreamInterface $stream)
    {
        $response->getStatusCode()->willReturn(417);
        $response->getBody()->willReturn($stream);
        $stream->getContents()->willReturn(
            '{"message":"Crashed at position 12,4.","map":"##  x ###\n##  *  ##\n##  *  ##\n##  * ###\n##  *  ##\n### *  ##\n### *   #\n##  #####"}'
        );

        $this->getMap()->shouldBe(['#','#',' ',' ','#','#','#','#','#']);
    }

}

