<?php


namespace DeathStarNavigator;

use Buzz\Client\Curl;
use Nyholm\Psr7\Factory\HttplugFactory;
use Nyholm\Psr7\Request;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

class NavigationService implements NavigationInterface
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $client;
    /**
     * @var RequestInterface
     */
    private RequestInterface $request;
    /**
     * @var Config
     */
    private Config $config;

    public function __construct(ClientInterface $client = null, RequestInterface $request = null)
    {
        $this->config = Config::get();

        if (is_null($client)) {
            $responseFactory = new HttplugFactory();
            $client = new Curl($responseFactory);
        }

        if (is_null($request)) {
            $request = new Request('GET', $this->config->getUri());
        }

        $this->client = $client;
        $this->request = $request;
    }

    public function navigate(Path $path) : CrashReport
    {
        $request = $this->request->withUri(
            $this->config->getUri()->withQuery(sprintf('name=%s&path=%s', $this->config->getName(), (string)$path))
        );

        $parser = new ResponseParser($this->client->sendRequest($request));

        return new CrashReport(
            $parser->hasCrashed(),
            $parser->getCrashLocation(),
            $parser->getMap(),
            $parser->isLost(),
        );
    }
}
