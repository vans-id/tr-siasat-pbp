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
        <a class="nav-link" href="kelas.php">
          Kelas
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
            <li class="breadcrumb-item"><span>Matakuliah</span></li>
            <li class="breadcrumb-item active"><span>Tambah</span></li>
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
              <h4 class="mb-3">Tambah Matakuliah</h4>
              <?php
              require_once "functions.php";

              if (!isset($_SESSION['user'])) {
                header("Location: login.php");
              } else {
                if (isset($_POST['tambah'])) {
                  $tambah_data['code'] = isset($_POST['code']) ? $_POST['code'] : "";
                  $tambah_data['name'] = isset($_POST['name']) ? $_POST['name'] : "";
                  $tambah_data['major'] = isset($_POST['major']) ? $_POST['major'] : "";
                  $tambah_data['sks_a'] = isset($_POST['sks_a']) ? $_POST['sks_a'] : "";
                  $tambah_data['sks_b'] = isset($_POST['sks_b']) ? $_POST['sks_b'] : "";

                  if ($tambah_data['code'] == "" || $tambah_data['name'] == "" || $tambah_data['major'] == "" || $tambah_data['sks_a'] == "" || $tambah_data['sks_b'] == "") {
                    echo '<div class="alert alert-danger">Pastikan semua kolom sudah diisi!</div>';
                  } else {
                    $data = select_subject($tambah_data['code']);
                    if (sizeof($data) > 0) {
                      echo '<div class="alert alert-danger">Kode Matakuliah ' . $tambah_data['code'] . ' sudah terdaftar!</div>';
                    } else {
                      if (insert_subject($tambah_data)) echo '<div class="alert alert-success">Sukses tambah data Matakuliah dengan Kode ' . $tambah_data['code'] . '!</div>';
                      else echo '<div class="alert alert-danger">Gagal tambah data mahasiswa!</div>';
                    }
                  }
                }

                echo '
                <!-- Form -->
                <form method="POST">
                  <table class="table table-borderless">
                    <tr>
                        <th class="col-form-label">Fakultas</th>
                        <td>
                          <select class="form-control" onchange="fetchMajors(this.value);">
                            <option selected disabled>Pilih Fakultas</option>
                            <option>Fakultas Teknologi Informasi</option>
                            <option>Fakultas Psikologi</option>
                            <option>Fakultas Bahasa dan Seni</option>
                          </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Program Studi</th>
                        <td>
                          <select class="form-control" id="select_progdi" name="major" onchange="fetchSubjects(this.value);">
                          </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Kode</th>
                        <td><input type="text" class="form-control" name="code" placeholder="IN123" required></td>
                    </tr>

                    <tr>
                        <th>Matakuliah</th>
                        <td><input type="text" class="form-control" name="name" placeholder="Keamanan Data" required></td>
                    </tr>

                    <tr>
                        <th>SKS A</th>
                        <td><input type="text" class="form-control" name="sks_a" placeholder="4" required></td>
                    </tr>

                    <tr>
                        <th>SKS B</th>
                        <td><input type="text" class="form-control" name="sks_b" placeholder="5" required></td>
                    </tr>

                    <tr>
                        <td colspan="1"></td>
                        <td nowrap><button class="btn btn-primary" type="submit" name="tambah">Tambah</button>&nbsp;&nbsp;<a href="matakuliah.php" class="btn btn-outline-secondary ml-4">Kembali</a></td>
                    </tr>
                  </table>
                </form>
                <!-- End Form -->
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
  <script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
  <script src="vendors/simplebar/js/simplebar.min.js"></script>
  <!-- Custom Script -->
  <script src="tambah_matkul.js"></script>

</body>

</html>