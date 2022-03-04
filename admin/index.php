<?php
include_once "../include/functions.php";
include_once "../include/loginDetails.php";


$error = "";

if (isset($_POST['username'], $_POST['password'])) {
  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($id = verify_user($_POST['username'], $_POST['password'], $db_con)) {
      session_start();
      $_SESSION['id'] = $id;
      header("location: ./home.php");
    } else {
      $error = "Invalid credentials!";
    }
  } else {
    $error = "All fields are required*";
  }
}
include_once "../include/header.php";
?>
<main class="container">
  <section class="row">
    <section class="col-md-10 mx-auto mt-5" id="loginSection">
      <figure class="card">
        <section class="card-body">
          <form action="" method="post">
            <h2 class="card-text text-center text-primary">Login</h2>
            <div class="text-center text-danger mt-3 font-weight-bold"><?php echo $error; ?></div>
            <section class="form-group">
              <label for="username" class="font-weight-bold">User ID</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Username">
            </section>
            <section class="form-group">
              <label for="password" class="font-weight-bold">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            </section>
            <section class="form-group">
              <button type="submit" class="btn btn-primary btn-sm">Login</button>
            </section>
          </form>
        </section>
      </figure>
    </section>
  </section>
</main>
<?php
include_once "../include/footer.php";
?>