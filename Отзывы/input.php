<?php
function create_input(PDO $connection, $input)
{
  $query = $connection->prepare("INSERT INTO input(name, text) VALUES (:name, :text)");
  $query->bindParam("name", $input['name'], PDO::PARAM_STR);
  $query->bindParam("text", $input['text'], PDO::PARAM_STR);
  return $query->execute();
}




function create_db_connection()
{
  $DB_HOST = 'localhost';
  $DB_USER = 'root';
  $DB_DATABASE = 'zoo';
  $DB_PASSWORD = '';
  try {
    return new PDO("mysql:host=" . $DB_HOST . ";dbname=" . $DB_DATABASE, $DB_USER, $DB_PASSWORD);
  } catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
  }
}




$connection = create_db_connection();
create_input($connection, [
    'name' => $_POST['name'],
    'text' => $_POST['text'],
]);
header('Location:./index.php');


?>