<?php

class DBProducts
{
  private $host;
  private $db_name;
  private $username;
  private $password;
  private $connection;

  public function __construct($hostP, $db_nameP, $usernameP, $passwordP) 
  {
    $this->host = $hostP;
    $this->db_name = $db_nameP;
    $this->username = $usernameP;
    $this->password = $passwordP;

    $this -> connect();
  }

  private function connect()
  {
    try
    {
      $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
      $this->connection -> exec("set names utf8");
    } catch (PDOException $exception) 
    {
      echo("Connection error: " . $exception->getMessage());
      return 1;
    }
  }

  function saveData($name, $sku, $price, $quantity, $description, $categories = 0)
  {
    $query = $categories ? 
    'INSERT INTO products(name, sku, price, quantity, categories, description) VALUES( :name, :sku, :price, :quantity, :categories, :description)' :
    'INSERT INTO products(name, sku, price, quantity, description) VALUES( :name, :sku, :price, :quantity, :description)';
        
    $callToDb = $this->connection->prepare($query);
    
    $name=htmlspecialchars(strip_tags($name));
    $sku=htmlspecialchars(strip_tags($sku));
    $price=htmlspecialchars(strip_tags($price));
    $quantity=htmlspecialchars(strip_tags($quantity));
    $description=htmlspecialchars(strip_tags($description));
    
    $callToDb->bindParam(':name', $name);
    $callToDb->bindParam(':sku', $sku);
    $callToDb->bindParam(':price', $price);
    $callToDb->bindParam(':quantity', $quantity);
    $callToDb->bindParam(':description', $description);

    if($categories)
    {
      $categories=htmlspecialchars(strip_tags($categories));
      $callToDb->bindParam(':categories', $categories);
    }

    return $callToDb->execute();
  }

  function getDataFromSku($sku)
  {
    $query = "SELECT * FROM products WHERE sku = {$sku} ORDER BY id DESC LIMIT 1";
    $callToDb = $this -> connection -> query($query);
    
    return $callToDb -> fetch();
  }

  function getAllData()
  {
    $query = "SELECT * FROM products";
    $callToDb = $this -> connection -> query($query);
    
    return $callToDb -> fetchAll();
  }

  function removeValueFromSku($sku, $data)
  {
    $eval = " ";
    foreach($data as $key => $value)
    {
      $key=htmlspecialchars(strip_tags($key));
      $value=htmlspecialchars(strip_tags($value));

      if(($key == "name") | ($key == "description") )
      {
        $eval .= "$key='{$value}',";
      }
      else
      {
        if( ($key != "categories") & ($key != "sku"))
        {
          $eval .= "$key=0,";
        }
      }
    }
    $eval[-1] = " ";

    $query = "UPDATE products SET $eval WHERE sku={$sku}";
    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function updateValueFromSku($sku, $data)
  {
    $eval = " ";
    foreach($data as $key => $value)
    {
      $key=htmlspecialchars(strip_tags($key));
      $value=htmlspecialchars(strip_tags($value));

      if(($key == "name") | ($key == "description") )
      {
        $eval .= "$key='{$value}',";
      }
      else
      {
        if($key != "sku")
        {
          $eval .= "$key={$value},";
        }
      }
    }
    $eval[-1] = " ";

    $query = "SET FOREIGN_KEY_CHECKS=0;UPDATE products SET $eval WHERE sku={$sku};SET FOREIGN_KEY_CHECKS=1";

    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function deleteFromSku($sku)
  {
    $message=htmlspecialchars(strip_tags($sku));

    $query = "SET FOREIGN_KEY_CHECKS=0;DELETE FROM products WHERE sku={$sku};SET FOREIGN_KEY_CHECKS=1";
    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function __destruct()
  {
    $this -> connection = null;
  }
}

?>