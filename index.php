<?php

include_once './control/Request.php';
include_once './control/Router.php';
include_once './routes/Router_Categories.php';
include_once './routes/Router_Products.php';
include_once  './logs/log.php';

$routerAble = array 
  (
  "/api/V1/product/create/",
  "/api/V1/product/remove/",
  "/api/V1/product/update/",
  "/api/V1/product/delete/",
  "/api/V1/categories/create/",
  "/api/V1/categories/remove/",
  "/api/V1/categories/update/",
  "/api/V1/categories/delete/",
  "/api/V1/product/get/",
  "/api/V1/categories/get/"
  );

$router = new Router(new Request);
$routerCategorie = new Categories($router);
$routerProducts = new Products($router);
$fileRoot = fopen("./assets/dashboard.html", "r");

switch ($_SERVER["REQUEST_URI"]) {
  case "/": 
    while($out = fgets($fileRoot)) { echo $out; }
    fclose($fileRoot);
    log_gen(
      "
      {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
      on route -> /
      ------------------------------------------------------------------------------------------------------------------
      "
    );

    break;

  case $routerAble[0]:
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $routerProducts -> create();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[0]
        ------------------------------------------------------------------------------------------------------------------
        "
      ); 
      break;
    }  

  case $routerAble[1]:
    if($_SERVER["REQUEST_METHOD"] == "PATCH")
    {
      $routerProducts -> remove();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[1]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }
    
  case $routerAble[2]:
    if($_SERVER["REQUEST_METHOD"] == "PUT")
    {
      $routerProducts -> update();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[2]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    } 

  case $routerAble[3]:
    if($_SERVER["REQUEST_METHOD"] == "DELETE")  
    {
      $routerProducts->delete();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[3]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }

  case $routerAble[4]:
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $routerCategorie -> create();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[4]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }
    
  case $routerAble[5]:
    if($_SERVER["REQUEST_METHOD"] == "PATCH")
    {
      $routerCategorie -> remove();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[5]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }
    
  case $routerAble[6]:
    if($_SERVER["REQUEST_METHOD"] == "PUT")
    {
      $routerCategorie -> update();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[6]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    } 
    
  case $routerAble[7]:
    if($_SERVER["REQUEST_METHOD"] == "DELETE")
    {
      $routerCategorie->delete();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[7]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }
  case $routerAble[8]:
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $routerProducts->consult();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[8]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    } 
  case $routerAble[9]:
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
      $routerCategorie->consult();
      log_gen(
        "
        {$_SERVER["REMOTE_ADDR"]}:{$_SERVER["REMOTE_PORT"]}::{$_SERVER["HTTP_USER_AGENT"]}
        on route -> $routerAble[9]
        ------------------------------------------------------------------------------------------------------------------
        "
      );
      break;
    }  
    
  default:
    $router -> exit();
}

?>