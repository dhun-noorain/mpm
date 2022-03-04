<?php
session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header("location: ./index.php");
}
// logging out user
unset($_SESSION);
session_destroy();
header("location: ./index.php");
?>