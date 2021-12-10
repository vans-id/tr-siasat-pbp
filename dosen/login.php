<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Masuk sebagai Dosen - SIASAT</title>

  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <?php
          require_once "functions.php";

          if (isset($_SESSION['user'])) {
            header("location: index.php");
          } else {
            if (isset($_POST['login'])) {
              $user = $_POST['user'];
              $pass = $_POST['pass'];

              $userId = authLogin($user, $pass);

              if ($userId != null) {
                $_SESSION['user'] = $userId;
                header("location: index.php");
              } else {
                echo '<div class="alert alert-danger">Username/Password salah!</div>';
              }
            }
          }

          ?>
          <div class="card-group d-block d-md-flex row">
            <div class="card col-md-7 p-4 mb-0">
              <div class="card-body">
                <h1>Login</h1>
                <p class="text-medium-emphasis">Masuk SIASAT sebagai dosen</p>

                <form method="POST">
                  <div class="input-group mb-3"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                      </svg></span>
                    <input class="form-control" type="text" name="user" placeholder="NIP">
                  </div>
                  <div class="input-group mb-4"><span class="input-group-text">
                      <svg class="icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                      </svg></span>
                    <input class="form-control" type="password" placeholder="Password" name="pass">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" type="submit" name="login">Login</button>
                    </div>
                    <div class="col-6 text-end">
                      <button class="btn btn-link px-0" type="button">Forgot password?</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
</body>

</html>