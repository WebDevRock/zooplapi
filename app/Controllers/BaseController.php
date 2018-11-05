<?php
namespace Controllers;

use \Slim\Container;

class BaseController
{
    /** 
     * @var \Slim\Container
     */
    protected $container;

    public function __construct(Container $container)
    {
       $this->container = $container;     
    }

    public static function encode($data)
    {
        if (!is_object($data)) {
            throw new \Exception('$data is not an object.');
        }
		
        return json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL;
    }
    
}
