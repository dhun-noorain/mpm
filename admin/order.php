<?php
include_once '../include/session.php';

$orderId = sanitize_var($db_con, $_GET['id']);
$page = $_GET['page'];
$feedback = '';

if (isset($_POST['statusCode'])) {
  $status = intVal(sanitize_var($db_con, $_POST['statusCode']));
  if (is_int($status) && $status == 0) {
    $query = "UPDATE orders SET status = 1  WHERE id='$orderId'";
    if ($db_con->query($query)) {
      $feedback = "<div class='alert alert-success'>
          Order Completed! <a href='./home.php' class='alert-link'> Go Back </a>
        </div>";
    } else {
      $feedback = "<div class='alert alert-danger'> Order <strong>NOT</strong> Completed! </div>";
    }
  } else {
    $feedback = "<div class='alert alert-danger'> Something went wrong! </div>";
  }
}

if (isset($_POST['delId'])) {
  $delId = sanitize_var($db_con, $_POST['delId']);
  $query = "DELETE FROM orders WHERE id = '$delId'";
  if ($db_con->query($query)) {
    header("location: ./home.php");
  } else {
    $feedback = "<div class='alert alert-danger'> Order <strong>NOT DELETED!</strong> </div>";
  }
}

if (filter_var($orderId, FILTER_VALIDATE_INT)) {
  $order = getOrder($db_con, $orderId);
  // checks page whether to display complete and delte forms or not
  if ($page == 'home') {
    $forms = "<tr>
          <td>
            <form method='POST' action=''>
              <input type='hidden' name='statusCode' value='". $order['status'] ."'>
              <button type='submit' class='btn btn-success btn-sm'>Complete Order</button>
            </form>
          </td>
          <td>
            <form method='POST' action=''>
              <input type='hidden' name='delId' value='$orderId'>
              <button type='submit' class='btn btn-danger btn-sm'>Delete Order</button>
            </form>
          </td>
        </tr>";
  } elseif ($page == 'previous') {
    $forms = '';
  } else {
    header('location: ./home.php');
  }

  $orderView = "<table class='table table-striped text-capitalize mt-3'>
        <tr>
          $feedback
        </tr>
        <tr>
          <th>Name</th>
          <td>". $order['name'] ."</td>
        </tr>
        <tr>
          <th>Address</th>
          <td>". $order['address'] ."</td>
        </tr>
        <tr>
          <th>Phone</th>
          <td>". $order['phone'] ."</td>
        </tr>
        <tr>
          <th>Type</th>
          <td>". $order['pkg_type'] ."</td>
        </tr>
        <tr>
          <th>Price</th>
          <td>". $order['price'] ."</td>
        </tr>
        <tr>
          <th>Quantity</th>
          <td>". $order['quantity'] ."</td>
        </tr>
        <tr>
          <th>Date</th>
          <td>". $order['date'] ."</td>
        </tr>
        $forms
      </table>
  ";
} else {
  $orderView = "
    <div class='alert alert-danger'> <strong> No order found! </strong> </div>
  ";
}
?>


<main class="container">
  <section class="row">
    <section class="col-md-10 mx-auto">
      <a href=<?php echo "./$page.php"; ?> class="btn btn-secondary"> <i class="fas fa-arrow-left"></i> </a>
      <?php echo $orderView; ?>
    </section>
  </section>
</main>

<?php
include_once '../include/footer.php';
?>