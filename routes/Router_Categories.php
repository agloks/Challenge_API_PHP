<?php

include_once './model//DB_Controler_Categories.php';

class Categories
{
  private $router;
  private $db;
  
  function __construct(Router $rt) {
    $this -> router = $rt;
    $this -> db = new DBCategories("127.0.0.1", "webjump_challenge", "challenge", "123");
  }

  function consult()
  {
    $this -> router -> get("/api/V1/categories/get/", function($request)
    {
      $found = $this -> db -> getAllData();

      return json_encode($found);
    });
  }

  public function create()
  {
    $this -> router -> post("/api/V1/categories/create/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> saveData($data["name"], $data["code"]);
      $found = $this -> db -> getDataFromCode($data["code"]);

      return json_encode(["id" => $found["id"], "name" => $found["name"], "code" => $found["code"]]);
    });
  }
  
  public function remove()
  {
    $this -> router -> patch("/api/V1/categories/remove/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> removeNameFromCode($data["name"], $data["code"]);
      $found = $this -> db -> getDataFromCode($data["code"]);
      return json_encode(["id" => $found["id"], "name" => $found["name"], "code" => $found["code"]]);
    });
  }

  public function update()
  {
    $this -> router -> put("/api/V1/categories/update/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> updateNameFromCode($data["name"], $data["code"]);
      $found = $this -> db -> getDataFromCode($data["code"]);
      return json_encode(["id" => $found["id"], "name" => $found["name"], "code" => $found["code"]]);
    });
  }

  public function delete()
  {
    $this->router->delete("/api/V1/categories/delete/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> deleteFromCode($data["code"]);
      $found = $this -> db -> getDataFromCode($data["code"]);
      if($found) 
      {
        return json_encode(["error" => "code:{$data["code"]} not was possible delete"]);  
      }

      return json_encode(["sucess" => "code:{$data["code"]} deleted"]);
    });
  }
}

?>