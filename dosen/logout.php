<!DOCTYPE html>
<html lang="en">

<head>
  <title>Logout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="../css/style.css" rel="stylesheet">
</head>

<body>
  <div class="container" style="margin-top:50px">
    <?php
    session_start();
    session_destroy();
    echo '<div class="alert alert-warning">Loging out...</div>';
    header("Refresh: 1; url=login.php");
    ?>
  </div>
</body>

</html>