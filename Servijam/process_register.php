<?php
require 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$email = !empty($_POST['email']) ? $_POST['email'] : null;

// Verificar si el username ya existe
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->rowCount() > 0) {
    die("El nombre de usuario ya está en uso.");
}

// Insertar el nuevo usuario
$sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
    'username' => $username,
    'password' => $password, // ⚠️ Esto debería ser hasheado en una versión final
    'email' => $email
]);

echo "Registro exitoso. <a href='index.php'>Iniciar sesión</a>";
?>
