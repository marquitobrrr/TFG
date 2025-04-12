<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php';

$user_input = $_POST['user_input'];
$password_input = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = :input OR email = :input LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute(['input' => $user_input]);
$user = $stmt->fetch();

if ($user) {
    $hash = $user['password'];

    if (strlen($hash) < 60 || strpos($hash, '$2y$') !== 0) {
        if ($password_input === $hash) {
            $new_hash = password_hash($password_input, PASSWORD_DEFAULT);

            $update = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $update->execute([$new_hash, $user['id']]);

            $hash = $new_hash; 
        } else {
            echo "❌ Credenciales inválidas.";
            exit;
        }
    }

    if (password_verify($password_input, $hash)) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];


        if ($user['role'] === 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: user.php");
        }
        exit;
    }
}

echo "❌ Credenciales inválidas.";
?>
