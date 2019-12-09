<?php

include_once "./model/DB_Controler_Products.php";

class Products
{
  private $router;
  private $db;

  function __construct(Router $rt) {
    $this -> router = $rt;
    $this -> db = new DBProducts("127.0.0.1", "webjump_challenge", "challenge", "123");
  }

  function consult()
  {
    $this -> router -> get("/api/V1/product/get/", function($request)
    {
      $found = $this -> db -> getAllData();

      return json_encode($found);
    });
  }

  public function create()
  {
    $this -> router -> post("/api/V1/product/create/", function($request)
    {
      $data = $request -> getBody();
      if($data["categories"])
      {
        $this -> db -> saveData($data["name"], $data["sku"], $data["price"], $data["quantity"], $data["description"], $data["categories"]);
        $found = $this -> db -> getDataFromSku($data["sku"]);

        return json_encode(
          [
          "id" => $found["id"],
          "name" => $found["name"],
          "sku" => $found["sku"],
          "price" => $found["price"],
          "quantity" => $found["quantity"], 
          "description" => $found["description"],
          "categories" => $found["categories"]
          ]);
      }
      else
      {
        $this -> db -> saveData($data["name"], $data["sku"], $data["price"], $data["quantity"], $data["description"]);
        $found = $this -> db -> getDataFromSku($data["sku"]);

        return json_encode(
          [
          "id" => $found["id"],
          "name" => $found["name"],
          "sku" => $found["sku"],
          "price" => $found["price"],
          "quantity" => $found["quantity"], 
          "description" => $found["description"]
          ]);
      }
    });
  }
  
  public function remove()
  {
    $this -> router -> patch("/api/V1/product/remove/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> removeValueFromSku($data["sku"], $data);
      $found = $this -> db -> getDataFromSku($data["sku"]);

      return json_encode(
      [
      "id" => $found["id"],
      "name" => $found["name"],
      "sku" => $found["sku"],
      "price" => $found["price"],
      "quantity" => $found["quantity"], 
      "description" => $found["description"],
      "categories" => $found["categories"]
      ]);
    });
  }

  public function update()
  {
    $this -> router -> put("/api/V1/product/update/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> updateValueFromSku($data["sku"], $data);
      $found = $this -> db -> getDataFromSku($data["sku"]);
      
      return json_encode(
      [
      "id" => $found["id"],
      "name" => $found["name"],
      "sku" => $found["sku"],
      "price" => $found["price"],
      "quantity" => $found["quantity"], 
      "description" => $found["description"],
      "categories" => $found["categories"]
      ]);
    });
  }

  public function delete()
  {
    $this->router->delete("/api/V1/product/delete/", function($request)
    {
      $data = $request -> getBody();
      $bd = $this -> db -> deleteFromSku($data["sku"]);
      $found = $this -> db -> getDataFromSku($data["sku"]);
      if($found) 
      {
        return json_encode(["error" => "sku:{$data["sku"]} not was possible delete"]);  
      }

      return json_encode(["sucess" => "sku:{$data["sku"]} deleted"]);
    });
  }
}

?>