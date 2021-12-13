<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Matkul - Sistem Informasi dan Administrasi Universitas Kristen Satya Wacana</title>
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
   <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index2.php">Siasat</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index2.php" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="dashboard2.php">Dashboard</a></li>
          <li><a class="active" href="Matkul.php">Mata Kuliah</a></li>
          <li><a href="kst2.php">Kartu Studi</a></li>
          <li><a href="transkrip2.php">Transkrip</a></li>
          <li><a href="kredit2.php">Kredit</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="logout.php" class="get-started-btn">Logout</a>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade-in">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs text-dark" >
      <div class="container">
        <h2>Mata Kuliah</h2>
        <p>Semoga aktivitas belajarmu menyenangkan.</p>
      </div>
    </div><!-- End Breadcrumbs -->

    <!-- Table -->
    <div class="bg-light" >
      <div class="container py-5" data-aos="fade-up" >
        <div class="card p-4 table-responsive" data-aos="zoom-in" data-aos-delay="100">
          <table class="table table-hover"  >
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Matakuliah</th>
                <th scope="col">Nama Dosen</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Hari</th>
                <th scope="col">Ukuran</th>
                <th scope="col">Ambil</th>
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
                    $angka = substr($_SESSION['user'],0,2);
                    $query = mysqli_query($con, "SELECT table_classes.*,table_subjects.sks_a, table_subjects.name AS matkul FROM table_classes INNER JOIN table_subjects ON table_subjects.major LIKE '$angka%' AND table_subjects.code = table_classes.subject_id GROUP BY name");
                    $a = mysqli_num_rows($query);
  
                    while ($a > 0) {
                    $data = mysqli_fetch_array($query);
                    $data['$a'] = $data['size'];
                ?>
                <form method="POST">
                <tr>
                  <th scope="row"><?php echo $no ?></th>
                  <td><?php echo $data['subject_id']?><?php echo  $data['name']?></td>
                  <td><?php echo $data['matkul'].' ('?><?php echo $data['sks_a'].')'?></td>
                  <td>
                  <?php  
                  if($data['lecturer_id'] == 672819){
                  echo 'Vita Tantriyati';
                  }elseif($data['lecturer_id'] == 627128){
                  echo 'Yeremia';
                  }else{
                  echo 'Ineke Pakereng';
                  }     
                  ?>  
                  </td>
                  <td><?php echo $data['room']?></td>
                  <td><?php echo $data['day'].' '?><?php echo $data['start_time'].'-'?><?php echo $data['end_time']?></td>
                  <?php
                   UPDATE table_classes SET size = size-1 WHERE subject_id =: subject_id
                  if(isset($_POST['kurang'])){
                    $data['$a']--;

                    }
                  ?>
                  <td><?php echo $data['$a']?></td>
                  <td><button name="kurang" type="submit" class="btn btn-primary btn-sm">AMBIL</button></td>
                </tr>
                </form>

              <?php
                $no++;
                $a--;
                }
              }  
            ?>

            <?php
            $time=$data['start_time'];
              if(strtotime($time)<=strtotime('00:03:00')) {
               //do some work
              } else {
               //do something
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