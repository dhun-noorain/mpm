<?php
$db_host = 'localhost';
$db_username = 'id18533096_mpm_admin';
$db_password = 'gze\R(wp+lhrj|P4';
$db_name = 'id18533096_mpm';


$db_con = new mysqli($db_host, $db_username, $db_password, $db_name);

if ($db_con->connect_error) {
  die('Failed to connect!: ' . mysqli_connect_error());
}
?>