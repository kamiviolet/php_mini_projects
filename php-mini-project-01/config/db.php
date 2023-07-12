<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'kami');
define('DB_PASS', 'SQL^1234$');
define('DB_NAME', 'php_dev');

$connection = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($connection->connect_error) {
  die('Connection failed: ' . $connection->connect_error);
}
?>