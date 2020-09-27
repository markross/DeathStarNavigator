<?php

namespace spec\DeathStarNavigator;

use DeathStarNavigator\Config;
use DeathStarNavigator\Path;
use Nyholm\Psr7\Uri;
use PhpSpec\ObjectBehavior;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class NavigationServiceSpec extends ObjectBehavior
{
    function let(ClientInterface $client, RequestInterface $request)
    {
        $this->beConstructedWith($client, $request);
    }

    function it_sends_the_path_to_the_navigation_service(
        ClientInterface $client, Path $path,
        RequestInterface $request,
        ResponseInterface $response)
    {
        $pathString = 'fffrflfrl';
        $config = Config::get();
        $expectedUri = (new Uri($config->getUri()))->withQuery(sprintf('name=%s&path=%s', $config->getName(), $pathString));
        $path->__toString()->willReturn($pathString);
        $request->withUri($expectedUri)->willReturn($request);
        $client->sendRequest($request)->willReturn($response);

        $this->navigate($path);

        $request->withUri($expectedUri)->shouldHaveBeenCalled();
        $client->sendRequest($request)->shouldHaveBeenCalled();

    }
}
