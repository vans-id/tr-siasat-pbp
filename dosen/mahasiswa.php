<?php
require_once "functions.php";

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}

$students = [];
if (isset($_POST['search_student'])) {
  $nim = $_POST['nim'] ? $_POST['nim'] : "";

  if ($nim == "") {
    header("Location: mahasiswa.php");
  } else {
    $students = get_all_students($_SESSION['user'], $nim);
  }
} else {
  $students = get_all_students($_SESSION['user']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Daftar Mahasiswa Dosen - SIASAT</title>

  <!-- Vendors styles-->
  <link rel="stylesheet" href="vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="css/style.css" rel="stylesheet">
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
        <ul class="header-nav">
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
            <li class="breadcrumb-item active"><span>Mahasiswa</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- END HEADER -->

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <?php
        if (isset($_POST['give_mark'])) {
          if ($_POST['id'] == "" || $_POST['mark'] == "") {
            echo '<div class="alert alert-danger">Input nilai tidak valid</div>';
          } else {
            // print_r($_POST);
            if (edit_mark($_POST['id'], $_POST['mark'])) {
              echo '<div class="alert alert-success">Sukses memberi nilai mahasiswa (' . $_POST['student_id'] . ')!</div>';
            } else echo '<div class="alert alert-danger">Gagal memberi nilai mahasiswa!</div>';
          }
        }
        ?>
        <!-- ROW -->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body pb-0">
              <form method="POST">
                <div class="input-group mb-3">
                  <input type="text" name="nim" class="form-control" placeholder="Cari nim mahasiswa">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" name="search_student" type="submit" id="button-addon2">Cari</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- ROW -->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Daftar Mahasiswa</h3>
              </div>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Matakuliah</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Nilai</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($students as $key => $val) {
                  ?>
                    <tr>
                      <td><?= $val['student_id'] ?></td>
                      <td><?= $val['subject_id'] ?></td>
                      <td><?= $val['name'] ?></td>
                      <td><?= $val['class'] ?></td>
                      <form method="POST">
                        <td style="width: 70px;">
                          <input name="mark" type="text" value="<?= $val['mark'] ?>" placeholder="BC" class="form-control">
                          <input name="id" type="hidden" value="<?= $val['id'] ?>">
                          <input name="student_id" type="hidden" value="<?= $val['student_id'] ?>">
                        </td>
                        <td>
                          <button type="submit" name="give_mark" class="btn btn-outline-info">
                            Beri Nilai
                          </button>
                        </td>
                      </form>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
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
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>

</body>

</html>