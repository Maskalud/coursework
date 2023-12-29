<?php
function create_user(PDO $connection, $user)
{
  $password_hash = password_hash($user['password'], PASSWORD_BCRYPT);
  $query = $connection->prepare("INSERT INTO users(first_name, last_name, login, email, password_hash) VALUES (:first_name, :last_name, :login, :email, :password_hash)");
  $query->bindParam("first_name", $user['first_name'], PDO::PARAM_STR);
  $query->bindParam("last_name", $user['last_name'], PDO::PARAM_STR);
  $query->bindParam("login", $user['login'], PDO::PARAM_STR);
  $query->bindParam("email", $user['email'], PDO::PARAM_STR);
  $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
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
create_user($connection, [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'login' => $_POST['login'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);
header('Location:../Вход/index.php');

?>