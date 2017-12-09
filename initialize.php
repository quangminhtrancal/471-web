<?php
  ob_start(); // output buffering is turned on
  require_once('database.php');
  $db = db_connect();
  $errors = [];

?>
