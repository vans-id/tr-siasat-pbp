<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Sistem Informasi dan Administrasi Universitas Kristen Satya Wacana</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<script type="text/javascript" src="libs/jquery.form.js">
  angka = document.querySelector(".third").addEventListener("click", function(){
  Swal.fire("success");});
</script>    
<body>

<?php
require_once "functions.php";

if (isset($_SESSION['user'])) {
    header("Location: dashboard2.php");
} else {
    if(isset($_POST['login'])){
        $nim = $_POST['nim'];
        $pass = $_POST['pass'];

        if(check_login($nim, $pass)) {
        $_SESSION['user'] = $nim;
        $_SESSION['data'] = select_data($nim);
              header("Refresh: 2; url=dashboard2.php");
            } else {
              
            } 
        }
   echo '
   <!-- ======= Header ======= -->
   <form method="post">
   <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Siasat</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="beasiswa.php">Beasiswa</a></li>
          <li><a href="kalender.php">Calender</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="login.php" class="get-started-btn">Login</a>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs bg-light text-dark" data-aos="fade-in">
      <div class="container">
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card mt-5" >
              <div class="card-body p-4">
                <h5>Masuk Akun Kamu</h5>
                <form class="mt-4">
                  <input type="text" class="form-control mt-3" name="nim" id="nim" placeholder="Masukain NIM">
                  <input type="password" class="form-control mt-3" name = "pass" id="password" placeholder="Password">
                  <button type="submit" class="btn btn-primary mt-3 third" name="login">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Breadcrumbs -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Siasat</h3>
            <p>
              Jl. Diponegoro No.52-60<br>
              Salatiga, Jawa Tengah 50711<br>
              Indonesia<br><br>
              <strong>Phone:</strong> (0298) 321212<br>
              <strong>Email:</strong> help@contact.uksw.edu<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Tentang</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Jurusan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Syarat dan Ketentuan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Kebijakan Privasi</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Informasi</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Info Akademik</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Tentang UKSW</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Akademik</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Kemahasiswaan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Perpustakaan</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Lain Lain</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Lembaga penjamin mutu</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Unduhan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">UKSW Tour</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Hubungan Internasional</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>SIASAT</span></strong>. All Rights Reserved
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="index.php" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="index.php" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="index.php" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="index.php" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="index.php" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  </form>
  ';}
  ?>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


</body>

</html>