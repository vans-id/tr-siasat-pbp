<?php
require_once "functions.php";

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Kelas Dosen - SIASAT</title>

  <!-- Vendors styles-->
  <link rel="stylesheet" href="../vendors/simplebar/css/simplebar.css">
  <link rel="stylesheet" href="../css/vendors/simplebar.css">
  <!-- Main styles for this application-->
  <link href="../css/style.css" rel="stylesheet">
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
            <li class="breadcrumb-item active"><span>Kelas</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- END HEADER -->

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <?php
        $delete = isset($_GET['delete']) ? $_GET['delete'] : "";
        if ($delete != "") {
          $data = get_single_class($delete);

          if (delete_class($delete)) echo '<div class="alert alert-success">Sukses menghapus kelas!</div>';
          else echo '<div class="alert alert-danger">Gagal hapus kelas!</div>';
        }
        ?>
        <!-- ROW -->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Daftar Kelas</h3>
                <a href="add_kelas.php" class="btn btn-outline-primary">Tambah</a>
              </div>
              <table class="table table-responsive table-striped">
                <thead>
                  <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Matakuliah</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Jadwal</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $classes = get_all_classes();
                  foreach ($classes as $key => $val) {
                  ?>
                    <tr>
                      <td><?= $val['subject_id'] ?></td>
                      <td><?= $val['lecture'] ?></td>
                      <td><?= $val['name'] ?></td>
                      <td><?= $val['schedule'] ?></td>
                      <td><?= $val['room'] ?></td>
                      <td>
                        <a href="edit_kelas.php?edit=<?= $val['id'] ?>" class="btn btn-outline-info">
                          Edit
                        </a>
                        <a href="kelas.php?delete=<?= $val['id'] ?>" class="btn btn-outline-danger">Hapus</a>
                      </td>
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
  <script src="../vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="../vendors/simplebar/js/simplebar.min.js"></script>

</body>

</html>