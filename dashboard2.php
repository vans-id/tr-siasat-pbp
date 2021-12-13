<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Sistem Informasi dan Administrasi Universitas Kristen Satya Wacana</title>
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

<body>
  <?php
    require_once "functions.php";

      if (!isset($_SESSION['user'])) {
        header("Location: login.php");
      } else {
  echo '    
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index2.php">Siasat</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index2.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="dashboard2.php">Dashboard</a></li>
          <li><a href="Matkul.php">Mata Kuliah</a></li>
          <li><a href="kst2.php">Kartu Studi</a></li>
          <li><a href="transkrip2.php">Transkrip</a></li>
          <li><a href="kredit2.php">Kredit</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="logout.php" class="get-started-btn">Logout</a>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs text-dark" data-aos="fade-in">
      <div class="container">
        <h2>Selamat datang '.$_SESSION['data']['nama'].'</h2>
        <p>Semoga aktivitas belajarmu menyenangkan.</p>

        <div class="card mt-5">
          <div class="card-body p-4">
            <h5>Status Mahasiswa</h5>
            <table class="table table-borderless mt-3">
              <tbody>
                <tr>
                  <th scope="row">Nama</th>
                  <td>'.$_SESSION['data']['nama'].'</td>
                </tr>
                <tr>
                  <th scope="row">NIM</th>
                  <td>'.$_SESSION['user'].'</td>
                </tr>
                <tr>
                  <th scope="row">Alamat</th>
                  <td colspan="2">'.$_SESSION['data']['alamat'].'</td>
                </tr>
                <tr>
                  <th scope="row">Asal</th>
                  <td colspan="2">'.$_SESSION['data']['asal'].'</td>
                </tr>
                <tr>
                  <th scope="row">No Hp</th>
                  <td colspan="2">'.$_SESSION['data']['noHp'].'</td>
                </tr>
              </tbody>
            </table>
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
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Tentang</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Jurusan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Syarat dan Ketentuan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Kebijakan Privasi</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Informasi</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Info Akademik</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Tentang UKSW</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Akademik</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Kemahasiswaan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Perpustakaan</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Lain Lain</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Lembaga penjamin mutu</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Unduhan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">UKSW Tour</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="index2.php">Hubungan Internasional</a></li>
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
        <a href="index2.php" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="index2.php" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="index2.php" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="index2.php" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="index2.php" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>';
}  
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