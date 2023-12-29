<?php
    
    function authenticate_user(PDO $connection, $credentials): int|null
    {
      $query = $connection->prepare('SELECT * FROM users WHERE email=:email');
      if (!$query) {
        return null;
      }
      $query->bindParam('email', $credentials['email']);
      $query->execute();
      $user = $query->fetch();
      if (!$user) {
        return null;
      }
      if (password_verify($credentials['password'], $user['password_hash'])) {
        return $user['id'];
      }
      return null;
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
    $user_id = authenticate_user($connection, [
      'email' => $_POST['email'],
      'password' => $_POST['password'],
    ]);
    if (empty($user_id)) {
      header('Location:./index.html');
      exit;
    } else {
      session_start();
      $_SESSION['user_id'] = $user_id;
      header('Location:../Профиль/index.php');
      exit;
    }

?>