<?php
require_once "functions.php";

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
} else {
}
