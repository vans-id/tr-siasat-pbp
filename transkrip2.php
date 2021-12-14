<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Transkrip - Sistem Informasi dan Administrasi Universitas Kristen Satya Wacana</title>
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
  <!-- ======= Header ======= -->
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.php">Siasat</a></h1>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <?php
          require_once "functions.php";

          if (isset($_SESSION['user'])) {
          ?>
            <li><a href="dashboard2.php">Dashboard</a></li>
            <li><a href="Matkul.php">Mata Kuliah</a></li>
            <li><a href="kst2.php">Kartu Studi</a></li>
            <li><a href="transkrip2.php" class="active">Transkrip</a></li>
          <?php
          }
          ?>
          <li><a href="beasiswa.php">Beasiswa</a></li>
          <li><a href="kalender.php">Calender</a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <?php
      if (!isset($_SESSION['user'])) {
      ?>
        <a href="login.php" class="get-started-btn">Login</a>
      <?php
      } else {
      ?>
        <a href="logout.php" class="get-started-btn">Logout</a>
      <?php
      }
      ?>
    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade-in">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs text-dark">
      <div class="container">
        <h2>Transkrip Nilai</h2>
        <p>Semoga aktivitas belajarmu menyenangkan.</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- Table -->
    <div class="bg-light">
      <div class="container py-5" data-aos="fade-up">
        <div class="card p-4 table-responsive" data-aos="zoom-in" data-aos-delay="100">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">SKS</th>
                <th scope="col">Nilai</th>
                <th scope="col">AK</th>
                <th scope="col">Tahun Ambil</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once "functions.php";

              if (!isset($_SESSION['user'])) {
                header("Location: login.php");
              } else {
                $nim = $_SESSION['user'];
                $no = 1;
                $query = mysqli_query($con, 'SELECT * FROM tabel_transkip WHERE nim = ' . $_SESSION['user']);
                while ($data = mysqli_fetch_array($query)) {
              ?>
                  <tr>
                    <th scope="row"><?php echo $no ?></th>
                    <td><?php echo $data['Kode'] ?></td>
                    <td><?php echo $data['Matkul'] ?></td>
                    <td><?php echo $data['SKS'] ?></td>
                    <td><?php echo $data['Nilai'] ?></td>
                    <td><?php echo $data['AK'] ?></td>
                    <td><?php echo $data['TahunAmbil'] ?></td>
                  </tr>
              <?php
                  $no++;
                }
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
    <!-- End Table -->

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