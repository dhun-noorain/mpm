<?php
include_once './session.php';

$page = 'home';
$getOrders = getOrders($db_con, $page);

if ($getOrders) {
  $ordersDisplay = "<ul class='list-group'>";
  while ($orders = $getOrders->fetch_assoc()) {
    $linkId = $orders['id'];
    $ordersDisplay .= "
      <li class='list-group-item'> 
        <a href='order.php?id=$linkId&page=$page'>" . $orders["name"] . "</a>
      </li>
    ";
  } 
  $ordersDisplay .= "</ul>";
} else {
  $ordersDisplay = "<div class='alert alert-info'>You have no new orders</div>";
}

?>


<main class="container">
  <section class="row">
    <section class="col-md-10 mx-auto mt-1">
      <aside class="alert alert-success">
          You're logged in! <span class='font-weight-bold text-capitalize'><?php echo $adminUser; ?> </span>
      </aside>
    </section>
  </section>
  <section class="row">
    <section class="col-md-10 mx-auto mt-3">
       <h2 class='text-center text-primary'>Orders</h2>
       <?php echo $ordersDisplay ?>
    </section>
  </section>
</main>


<?php
include_once './footer.php';
?>