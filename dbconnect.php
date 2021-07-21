<?php

define('DSN', 'mysql:host=localhost;dbname=php_practice;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('OPTIONS', [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
]);

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS, OPTIONS);
} catch (PDOException $e) {
  echo $e->getMessage();
}

?>