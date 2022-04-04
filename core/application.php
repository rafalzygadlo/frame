<?php

/**
 * application
 * 
 * @category   core
 * @package    frame
 * @author     Rafał Żygadło <rafal@maxkod.pl>

 * @copyright  2016 maxkod.pl
 * @version    1.0
 */

namespace app\core;

use app\core\request;
use app\core\router;

class application {

    public $router;
    public $request;

    public function __construct($argv = null)
    {
        $this->request = new request($argv);        
        $this->router = new router();
        
    }
    
    public function run() 
    {
        $this->router->resolve($this->request);
    }

}
