<?php

session_start();

error_reporting(-1);
ini_set('display_errors', 1);

// DEV ENV
$configdb = array();
$configdb['db'] = "db_tr";
$configdb['host'] = "localhost";
$configdb['user'] = "root";
$configdb['pass'] = "";

// AWS ENV
// $dbhost = 'aa1xc1xvrpopcdk.cwkpxkr7hgts.ap-southeast-1.rds.amazonaws.com';
// $dbport = '3306';
// $dbname = 'db_tr';
// $charset = 'utf8';

// $dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
// $username = 'root';
// $password = 'test1234';

$con;

try {
  // $con = new PDO($dsn, $username, $password);
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
