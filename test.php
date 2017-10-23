<?php
/* Connect to a MySQL database using driver invocation */
$dsn = 'mysql:dbname=start_testing_php;host=localhost';
$user = 'dbuser';
$password = 'dbpass';

try {
      $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
      echo 'Connection failed: ' . $e->getMessage();
}

$sql = "INSERT INTO tasks (note, created) VALUES ('stuff', NOW())";
$dbh->query($sql);
