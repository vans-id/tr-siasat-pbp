<!DOCTYPE html>
<html lang="en">

<head>
  <base href="./">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Dashboard Admin - SIASAT</title>

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
      <h5 class="mb-0">Admin SIASAT</h5>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="matakuliah.php">
          Matakuliah
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dosen.php">
          Dosen
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
            <li class="breadcrumb-item active"><span>Dosen</span></li>
          </ol>
        </nav>
      </div>
    </header>
    <!-- END HEADER -->

    <div class="body flex-grow-1 px-3">
      <div class="container-lg">
        <!-- ROW -->
        <div class="row">
          <div class="card mb-4">
            <div class="card-body pb-0">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Daftar Dosen</h3>
                <a href="tambah_dosen.php" class="btn btn-outline-primary">Tambah</a>
              </div>
              <?php
              require_once "functions.php";

              if (!isset($_SESSION['user'])) {
                header("Location: login.php");
              } else {
                $hapus = isset($_GET['hapus']) ? $_GET['hapus'] : "";
                if ($hapus != "") {
                  $nim = "";
                  $data = select_lecturer($hapus);

                  if (delete_data($hapus)) echo '<div class="alert alert-success">Sukses hapus data dengan Kode Dosen ' . $hapus . '!</div>';
                  else echo '<div class="alert alert-danger">Gagal hapus data dengan Kode Dosen ' . $hapus . '!</div>';
                }

                $data_table = '';
                $data = select_lecturer();
                foreach ($data as $key => $val) {
                  $data_table .= '
                    <tr>
                      <td>' . $val['nim'] . '</td>
                      <td>' . $val['name'] . '</td>
                      <td>' . $val['origin'] . '</td>
                      <td>' . $val['contact'] . '</td>
                      <td>
                        <a class="btn btn-outline-info" href="edit_dosen.php?nim=' . $val['nim'] . '">Edit</a>
                        <a class="btn btn-outline-danger" href="dosen.php?hapus=' . $val['nim'] . '">Hapus</a>
                      </td>
                    </tr>
                ';
                }

                if ($data_table == "") {
                  $data_table = '<tr class="table-danger"><th colspan="5"><center>NO DATA</center></th></tr>';
                }

                echo '
                <table class="table table-responsive table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Kode Dosen</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Asal</th>
                      <th scope="col">Kontak</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      ' . $data_table . '
                    </tr>
                  </tbody>
                </table>
                ';
              }
              ?>
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