<?php

class Router
{
  private $request;
  private $supportedHttpMethods = array( "GET", "POST", "PUT", "PATCH", "DELETE" );
  private $nameOrigin;

  function __construct(Request $request) { $this -> request = $request; }

  function __call($name, $args)
  {
    if($name != "exit") 
    {
      list($route, $method) = $args;
      $this -> {strtolower($name)}[$this->formatRoute($route)] = $method;
      $this -> nameOrigin = $route;
    }
  }

  private function formatRoute($route)
  {
    $result = rtrim($route, '/');
    if ($result === '')
    {
      return '/';
    }
    return $result;
  }

  private function invalidMethodHandler()
  {
    header("{$this-> request-> SERVER_PROTOCOL} 405 Method Not Allowed");
  }
  
  private function defaultRequestHandler()
  {
    header("{$this-> request -> SERVER_PROTOCOL} 404 Not Found");
  }
  
  public function resolve()
  {
    $methodDictionary = $this -> {strtolower($this -> request -> REQUEST_METHOD)};
    $formatedRoute = $this -> formatRoute($this -> request -> REQUEST_URI);
    $method = $methodDictionary[$formatedRoute];
    if(is_null($method))
    {
      $this -> defaultRequestHandler();
      return;
    }
    echo(call_user_func_array($method, array($this->request)));
  }
  
  function __destruct()
  {
    if(!in_array($this -> request -> REQUEST_METHOD, $this -> supportedHttpMethods))
    {
      $this -> invalidMethodHandler();
    } 
    else
    {
      $this->resolve();
    }
  }
}

?>