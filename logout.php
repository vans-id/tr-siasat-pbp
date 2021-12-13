<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Logout</title>
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

  <style type="text/css">
  	.spinner{
  		margin-top:17%; 
  		text-align:center;
  	}
  </style>
</head>

<body style="background-color: rgba(239,247,255,255)">
  	<?php
	session_start();
	session_destroy();
	echo '
		 <divclass = "container">                                
		  <div class ="spinner">
		  <div style="background-color:rgba(26,26,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(51,51,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(77,77,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(102,102,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(153,153,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(179,179,255,1);" class="spinner-grow"></div>
		  <div style="background-color:rgba(204,204,255,1);" class="spinner-grow"></div>
		  <br>
		  <br>
		  <h1 class="logo me-auto"><a href="index.php">Terima Kasih</a></h1>
		  <div>
		</div>
	';
	header("Refresh: 2; url=login.php");
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