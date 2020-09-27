<?php

namespace DeathStarNavigator;

use Psr\Http\Message\ResponseInterface;

/**
 * Parses a response from the API
 *
 * Class ResponseParser
 * @package DeathStarNavigator
 */
class ResponseParser
{
    const STATUS_LOST       = 410;
    const STATUS_CRASHED    = 417;
    const STATUS_FOUND      = 200;
    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    private bool $isCrashed = false;

    private array $crashLocation = [];

    private bool $isFound = false;

    private bool $isLost = false;

    private \stdClass $body;

    private array $map = [];

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->parse();
    }

    public function parse()
    {
        $status = $this->response->getStatusCode();
        $this->isFound = $status === self::STATUS_FOUND;
        $this->isCrashed = $status === self::STATUS_CRASHED;
        $this->isLost = $status === self::STATUS_LOST;

        if ($this->isCrashed) {
            $this->crashLocation = $this->parseCrashLocation();
            $map = $this->body->map;
            $mapLines = explode(PHP_EOL, $map);
            $lastLine = str_split(end($mapLines));
            $this->map = $lastLine;
        }
    }

    public function hasCrashed() : bool
    {
        return $this->isCrashed;
    }

    public function isFound() : bool
    {
        return $this->isFound;
    }

    public function isLost() : bool
    {
        return $this->isLost;
    }

    public function getCrashLocation() : array
    {
        return $this->crashLocation;
    }


    private function parseCrashLocation()
    {
        $this->body = json_decode($this->response->getBody()->getContents());
        preg_match('/(\d{1,3}),(\d{1})/', $this->body->message, $matches);
        return [(int)$matches[1], (int)$matches[2]];
    }

    public function getMap() : array
    {
        return $this->map;
    }
}
