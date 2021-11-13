<?php

session_start();

include_once './loginDetails.php';
include_once './functions.php';
include_once './header.php';

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
  header("location: login.php");
}
// logging out user
if (isset($_GET['logout']) && !empty($_GET['logout'])) {
  logout($_SESSION);
}

$adminId = $_SESSION['id'];
$adminUser = getAdmin($db_con, $_SESSION['id']);
if (!$adminUser) {
  logout($_SESSION);
}

?>

<nav class="navbar navbar-expand-sm bg-light navbar-dark mb-2">
  <div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
      <i class="fas fa-user fa-1x"></i>
    </button>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="./home.php">Orders</a>
      <a class="dropdown-item" href="./previous.php">Previous</a>
      <div class="dropdown-divider"></div>
      <a href="home.php?logout=1" class="dropdown-item">Log out</a>
    </div>
  </div>
</nav>