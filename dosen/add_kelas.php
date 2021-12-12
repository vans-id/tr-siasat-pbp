<?php
require_once "functions.php";

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

if (isset($_POST['subject'])) {
  $subject = strval($_POST['subject']);
  $response = get_subjects_by_major($subject);
  $i = 0;
  foreach ($response as $res) {
    echo "<option value=" . $res . ">$res</option>";
    $i++;
  }
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Dashboard Admin - SIASAT</title>

  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
  <!-- We use those styles to show code examples, you should remove them in your application.-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css">
  <link href="css/examples.css" rel="stylesheet">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <h5 class="mb-0">SIASAT Dosen</h5>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="kelas.php">
          Kelas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="mahasiswa.php">
          Mahasiswa
        </a>
      </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>
  <!-- END SIDEBAR -->

  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <!-- HEADER -->
    <header class="header header-sticky mb-4">
      <div class="container-fluid">
        <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
        <ul class="header-nav ms-3">
          <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </ul>
      </div>
      <div class="header-divider"></div>
      <div class="container-fluid">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb my-0 ms-2">
            <li class="breadcrumb-item">
              <!-- if breadcrumb is single--><span>Home</span>
            </li>
            <li class="breadcrumb-item active"><span>Dashboard</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- END HEADER -->

    <div class="body flex-grow-1 px-3">
      <?php
      if (isset($_POST['add_class'])) {
        $newClass['subject_id'] = isset($_POST['subject_id']) ? $_POST['subject_id'] : "";
        $newClass['lecturer_id'] = $_SESSION['user'];
        $newClass['name'] = isset($_POST['name']) ? $_POST['name'] : "";
        $newClass['room'] = isset($_POST['room']) ? $_POST['room'] : "";
        $newClass['size'] = isset($_POST['size']) ? $_POST['size'] : "";
        $newClass['day'] = isset($_POST['day']) ? $_POST['day'] : "";
        $newClass['start_time'] = isset($_POST['start_time']) ? $_POST['start_time'] : "";
        $newClass['end_time'] = isset($_POST['end_time']) ? $_POST['end_time'] : "";

        if ($newClass['subject_id'] == "" || $newClass['name'] == "" || $newClass['room'] == "" || $newClass['size'] == "" || $newClass['day'] == "" || $newClass['start_time'] == "" || $newClass['end_time'] == "") {
          echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
        } else {
          if (add_class($newClass)) echo '<div class="alert alert-success">Sukses tambah data kelas (' . $newClass['subject_id'] . ')!</div>';
          else echo '<div class="alert alert-danger">Gagal tambah data mahasiswa!</div>';
        }
      }
      ?>
      <div class="container-lg">
        <!-- ROW -->
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="card mb-5">
              <div class="card-body pb-0">
                <h4 class="mb-3">Tambah Kelas</h4>
                <!-- Form -->
                <form method="POST">
                  <div class="mb-3">
                    <label for="" class="form-label">Fakultas</label>
                    <select class="form-control" onchange="fetchMajors(this.value);">
                      <option selected disabled>Pilih Fakultas</option>
                      <option>Fakultas Teknologi Informasi</option>
                      <option>Fakultas Psikologi</option>
                      <option>Fakultas Bahasa dan Seni</option>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Program Studi</label>
                    <select class="form-control" id="select_progdi" name="major" onchange="fetchSubjects(this.value);">
                    </select>
                  </div>

                  <div class="mb-3">
                    <label for="subject_id" class="form-label">Kode</label>
                    <select name="subject_id" class="form-control" id="select_subjects" name="subject_id">
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Jadwal</label>
                    <div class="row">
                      <div class="col">
                        <select class="form-control" name="day">
                          <option selected disabled>Pilih Hari</option>
                          <option value="Senin">Senin</option>
                          <option value="Selasa">Selasa</option>
                          <option value="Rabu">Rabu</option>
                          <option value="Kamis">Kamis</option>
                          <option value="Jumat">Jumat</option>
                        </select>
                      </div>
                      <div class="col">
                        <input type="text" name="start_time" class="form-control timepicker" placeholder="Jam Mulai" autocomplete="off">
                      </div>
                      <div class="col">
                        <input type="text" name="end_time" class="form-control timepicker" placeholder="Jam Akhir" autocomplete="off">
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" class="form-control" name="name" placeholder="X">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Ruangan</label>
                    <input type="text" class="form-control" name="room" placeholder="FTI464">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Kursi</label>
                    <input type="number" class="form-control" name="size" placeholder="40">
                  </div>

                  <div class="mb-3">
                    <button type="submit" name="add_class" class="btn btn-primary">Tambah</button>
                    <a href="kelas.php" class="btn btn-outline-secondary ml-4">Kembali</a>
                  </div>
                </form>
                <!-- End Form -->
              </div>
            </div>
          </div>
        </div>
        <!-- /.row-->
      </div>
    </div>
    <footer class="footer">
      <div>© 2021 Siasat.</div>
    </footer>
  </div>
  <!-- CoreUI and necessary plugins-->
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <!-- Custom Script -->
  <script src="add_script.js"></script>
</body>

</html>