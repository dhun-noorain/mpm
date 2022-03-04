<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha512-znmTf4HNoF9U6mfB6KlhAShbRvbt4CvCaHoNV0gyssfToNQ/9A0eNdUbvsSwOIUoJdMjFG2ndSvr0Lo3ZpsTqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Your order</title>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-danger navbar-dark">
  <a class="navbar-brand font-weight-bold" href="./index.html">
    M P M <i class="fas fa-utensils" aria-hidden="true"></i> 
  </a>
</nav>

<main>
  <section class="container">
    <section class="row">
      <section class="col-md-10 mx-auto mt-5">      
<?php
include_once './include/loginDetails.php';
include_once './include/functions.php';


if(isset($_POST['name'], $_POST['addr'], $_POST['phone'], $_POST['type'], $_POST['price'], $_POST['quantity'])) {
  $name = sanitize_var($db_con, $_POST['name']);
  $address = sanitize_var($db_con, $_POST['addr']);
  $phone = sanitize_var($db_con, $_POST['phone']);
  $type = sanitize_var($db_con, $_POST['type']);
  $price = sanitize_var($db_con, $_POST['price']);
  $quantity = sanitize_var($db_con, $_POST['quantity']);
  // checking for empty form variables
  if(!empty($name) && !empty($address) && !empty($phone) && !empty($type) && !empty($price) && !empty($quantity)) {
    // validating the phone, type and quantity fields
    if (check_phone($phone) === TRUE && check_type($type) === TRUE && check_quantity($quantity) === TRUE) {
      // inseting user order into the 'orders' table
      $query = $db_con->prepare("INSERT INTO orders(name, address, phone, pkg_type, price, quantity) VALUES(?, ?, ?, ?, ?, ?)");
      $query->bind_param("ssssss", $o_name, $o_addr, $o_phone, $o_type, $o_price, $o_quantity);
      // setting parameter vakues
      $o_name = $name;
      $o_addr = $address;
      $o_phone = $phone;
      $o_type = $type;
      $o_price = $price;
      $o_quantity = $quantity;
        // returning a receipt if the order was successfully entered
        if($query->execute() === TRUE) {
          $recordId = $db_con->insert_id;
          echo "<aside class='alert alert-success'>Your order was successful!</aside>";
          $query = "SELECT * FROM orders WHERE id = '$recordId'";
          $result = $db_con->query($query);
          if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            echo "<table class='table table-striped text-capitalize'>
              <tbody>
                <tr>
                  <th>Name</th>
                  <td>" . $order['name'] . "</td>
                </tr>
                <tr>
                  <th>Address</th>
                  <td>" . $order['address'] . "</td>
                </tr>
                <tr>
                  <th>Phone</th>
                  <td>" . $order['phone'] . "</td>
                </tr>
                <tr>
                  <th>Package</th>
                  <td class='text-uppercase'>" . $order['pkg_type'] . "</td>
                </tr>
                <tr>
                  <th>Price(N)</th>
                  <td>" . $order['price'] . "</td>
                </tr>
                <tr>
                  <th>Quantity</th>
                  <td>" . $order['quantity'] . "</td>
                </tr>
              </tbody>
            </table>";
        }
      } else {
        echo "<div class='alert alert-danger'><strong>FAILED</strong><div>";
      }
    } else {
      echo "<div class='alert alert-danger'>
      <strong>Error!</strong> You should <a href='./index.html' class='alert-link'>properly fill out the form in the previous page</a>.
    </div>";
    }
  } else {
    echo "<div class='alert alert-danger'>
    <strong>Error!</strong> You should <a href='./index.html' class='alert-link'>fill out the form in the previous page</a>.
  </div>";
  }
} else {
  echo "<div class='alert alert-danger'>
          No order was placed. <a href='./index.html' class='alert-link'>Please go back</a> 
        </div>";
}

echo "</section>
    </section>
  </section>
</main>";

include_once './include/footer.php';
?>