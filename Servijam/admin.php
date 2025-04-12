<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

echo "<h1>Hola admin</h1>";
?>
