<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'user') {
    header("Location: index.php");
    exit;
}

echo "<h1>Hola user</h1>";
?>
