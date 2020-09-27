<?php

namespace DeathStarNavigator;

use Psr\Http\Message\ResponseInterface;

class ResponseParser
{
    const STATUS_CRASHED = 417;
    const STATUS_FOUND = 200;
    /**
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    private bool $isCrashed = false;

    private array $crashLocation = [];

//    private array $nextMove = [];
    private bool $isFound = false;
    /**
     * @var mixed
     */
    private $body;
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

    public function getCrashLocation() : array
    {
        return $this->crashLocation;
    }

//    public function getNextMove() : array
//    {
//        return $this->nextMove;
//    }

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
