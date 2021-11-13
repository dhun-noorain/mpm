<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'db_mpm';

$db_con = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($db_con->connect_error) {
  die('Failed to connect!: ' . mysqli_connect_error());
}
?>