<?php

class DBCategories
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

  function saveData($name, $code)
  {
    $query = "INSERT INTO categories(name, code) VALUES( :name, :code)";

    $callToDb = $this -> connection -> prepare( $query );
    $name=htmlspecialchars(strip_tags($name));
    $code=htmlspecialchars(strip_tags($code));
    $callToDb -> bindParam(":name", $name);
    $callToDb -> bindParam(":code", $code);

    return $callToDb->execute();
  }

  function getDataFromCode($code)
  {
    $query = "SELECT * FROM categories WHERE code = {$code} ORDER BY id DESC LIMIT 1";
    $callToDb = $this -> connection -> query($query);
    
    return $callToDb -> fetch();
  }

  function getAllData()
  {
    $query = "SELECT * FROM categories";
    $callToDb = $this -> connection -> query($query);
    
    return $callToDb -> fetchAll();
  }

  function removeNameFromCode($name, $code)
  {
    if($name != "remove") { return 0; }

    $name=htmlspecialchars(strip_tags($name));
    $message=htmlspecialchars(strip_tags($code));

    $query = "UPDATE categories SET name='{$name}' WHERE code={$code}";
    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function updateNameFromCode($name, $code)
  {
    $name=htmlspecialchars(strip_tags($name));
    $message=htmlspecialchars(strip_tags($code));

    $query = "SET FOREIGN_KEY_CHECKS=0;UPDATE categories SET name='{$name}' WHERE code={$code};SET FOREIGN_KEY_CHECKS=1";
    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function deleteFromCode($code)
  {
    $message=htmlspecialchars(strip_tags($code));

    $query = "SET FOREIGN_KEY_CHECKS=0;DELETE FROM categories WHERE code={$code};SET FOREIGN_KEY_CHECKS=1";

    $callToDb = $this -> connection -> prepare($query);

    return $callToDb->execute();
  }

  function __destruct()
  {
    $this -> connection = null;
  }
}

?>