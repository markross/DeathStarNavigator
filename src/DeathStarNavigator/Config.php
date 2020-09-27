<?php


namespace DeathStarNavigator;

use Nyholm\Psr7\Uri;

class Config
{
    /**
     * @var Uri $uri
     */
    private Uri $uri;
    /**
     * @var int
     */
    private int $tunnelLength;
    /**
     * @var string
     */
    private string $name;
    /**
     * @var null|Config
     */
    private static $instance = null;

    public function __construct()
    {
        $config = json_decode(file_get_contents('./config.json'));
        $this->uri = new Uri($config->uri);
        $this->uri = $this->uri->withQuery(sprintf("name=%s", $config->name));
        $this->name = $config->name;
        $this->tunnelLength = $config->tunnel_length;
    }
    /**
     * @return Uri
     */
    public function getUri() : Uri
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getTunnelLength() : int
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
