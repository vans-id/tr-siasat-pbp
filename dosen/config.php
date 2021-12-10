<?php

// require_once "seeder.php";

session_start();

error_reporting(-1);
ini_set('display_errors', 1);

// DEV ENV
$configdb = array();
$configdb['db'] = "db_tr";
$configdb['host'] = "localhost";
$configdb['user'] = "root";
$configdb['pass'] = "";

$con;

try {
  $con = new PDO("mysql:host=" . $configdb['host'] . ";dbname=" . $configdb['db'] . ";charset=utf8;", $configdb['user'], $configdb['pass']);


  if ($con) {
    // proteksi sql injection
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } else {
    die("Failed connect db");
  }
} catch (Exception $e) {
  die("Failed connect db : " . $e->getMessage());
}
