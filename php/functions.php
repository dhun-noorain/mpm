<?php

function sanitize_var($con, $field) {
  $field = trim($field);
  $field = stripslashes($field);
  $field = strip_tags($field);
  $field = htmlspecialchars($field);
  $field = htmlentities($field);
  $con->real_escape_string($field);
  return $field;
}

function check_phone($field) {
  if(strlen($field) != 11) {
    return false;
  }
  return true;
}

function check_type($field) { 
  $types = ["regular", "vip", "vvip"];
  $length = count($types);
  for($i = 0; $i < $length; $i++) {
    if ($field == $types[$i]) {
      return true;
    }
  }
  return false;
}

function check_quantity($field) {
  if(!filter_var($field, FILTER_VALIDATE_INT)) {
    return false;
  }
  return true;
}

function getAdmin($db, $adminId) {
  $adminId = sanitize_var($db, $adminId);
  $query = $db->prepare("SELECT username FROM users WHERE id = ?");
  $query->bind_param('s', $u_id);
  $u_id = $adminId;
  if ($query->execute() === TRUE) {
    $query->store_result();
    $query->bind_result($username);
    if ($query->num_rows == 1) {
      while ($query->fetch()) {
        return $username;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function logout($session) {
  $session['id'] = '';
  unset($session['id']);
  session_destroy();
  header("location: login.php");
}

function verify_user($un, $pw, $db) {
  $un = sanitize_var($db, $un);
  $pw = sanitize_var($db, $pw);
  // salting and hashing
  $pw = 'xx'.$pw.'xx';
  $pw = md5($pw);
  // check for user in db
  $query = $db->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
  $query->bind_param('ss', $u_un, $u_pw);
  $u_un = $un;
  $u_pw = $pw;
  if ($query->execute() === TRUE) {
    $query->store_result();
    $query->bind_result($id);
    if ($query->num_rows == 1) {
      while ($query->fetch()) {
        return $id;
      }
    } else {
      return false;
    }
  } else {
    return false;
  }
}

function getOrders($db, $page) {
  if ($page == 'home') {
    $query = "SELECT id, name FROM orders WHERE status = 0 ORDER BY id";
  } elseif ($page == 'previous') {
    $query = "SELECT id, name FROM orders WHERE status = 1 ORDER BY id DESC";
  }
  $result = $db->query($query);
  if ($result->num_rows > 0) {
    return $result;
  }
  return false;
}

function getOrder($db, $id) {
  $query = "SELECT name, address, phone, pkg_type, price, quantity, date, status
              FROM orders WHERE id = '$id'";
  $result = $db->query($query);
  if ($result->num_rows > 0) {
    return $result->fetch_assoc();
  }
  return false;
}

?>