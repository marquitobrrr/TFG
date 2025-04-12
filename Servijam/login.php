<?php
session_start();
require 'db.php';

$user_input = $_POST['user_input'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = :input OR email = :input LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['input' => $user_input]);
$user = $stmt->fetch();

if ($user && $user['password'] === $password) {
    $_SESSION['user'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: user.php");
    }
    exit;
} else {
    echo "Credenciales inválidas.";
}
?>
