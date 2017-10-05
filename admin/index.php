<?php
if (isset($_GET['stat'])){
  if ($_GET['stat'] == 1) {
    echo "<script>alert('Username dan Password salah!');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
</head>
<body>
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-sm-offset-2" style="top: 50%; position: relative; transform:translate(50%, 50%);">
          <div class="account-wall">
            <h3 class="text-center login-title" style="margin-top: 5px;">Welcome Back! Please Sign In</h3>
            <form class="form-signin" action="login.php" method="POST">
              <input type="text" name="user" class="form-control" placeholder="Username" required autofocus>
              <input type="password" name="pass" class="form-control" placeholder="Password" required>
              <button class="btn btn-lg btn-primary btn-block" type="submit">
                Sign in</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</body>
</html>