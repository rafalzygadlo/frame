<?php

namespace app\core;

class router
{
    protected $routes = [];
     
    public function get($path, $callback, $param  = array())
    {
        array_push($this->routes, array('method' => 'get', 'path' => $path, 'callback' => $callback, 'param' => $param));       
    }
    
    public function post($path, $callback, $param = array())
    {
        array_push($this->routes, array('method' => 'post' , 'path' => $path, 'callback' => $callback, 'param' => $param));       
    }

    private function run($request, $route, $path)
    {
        
        if($route['method'] != $request->get_method())
            return false;


        $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['path'])) . "$@D";

        if (!preg_match($pattern, $path, $matches ) ) 
            return false;
                    
        $callback = $route['callback']; 
        if(!$callback)
            $callback = false;
        
        unset($matches[0]);
            
        if(!is_array($callback))
        {       
            call_user_func($callback, $request);
            return true;
        }

        $callback[0] = new $callback[0]();
                               
        foreach($callback[0]->actions as $action)
		{
            $action->run($request);
        }
                
        if(count($matches) > 0)
            call_user_func_array($callback, $matches);
        else
            call_user_func($callback, $request);
                
        return true;
        
        
    }


    public function resolve($request)
    {
        $path = $request->get_path();
              
        foreach($_GET as $key => $value)
        {
            $request->{$key} = $value;
        }

        foreach($this->routes as $route)
        {
           if($this->run($request, $route, $path))
            return;
        }
         
        $request->redirect('/404.html');
    }
    
}

