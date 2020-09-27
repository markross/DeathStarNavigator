<?php


namespace DeathStarNavigator;

use Nyholm\Psr7\Uri;

class Config
{
    /**
     * @var Uri $uri
     */
    private $uri;
    private $tunnelLength;
    private static $instance = null;

    public function __construct()
    {
        // @TODO error checking
        $config = json_decode(file_get_contents('./config.json'));
        $this->uri = new Uri($config->uri);
        $this->uri = $this->uri->withQuery(sprintf("name=%s", $config->name));
        $this->name = $config->name;
        $this->tunnelLength = $config->tunnel_length;
    }
    /**
     * @return mixed
     */
    public function getUri() : Uri
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getTunnelLength()
    {
        return $this->tunnelLength;
    }

    public static function get() : self
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
