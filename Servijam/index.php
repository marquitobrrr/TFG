<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Servidor de Impresión 3D</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="login.php" method="post">
        <label>Usuario o Email:</label><br>
        <input type="text" name="user_input" required><br><br>
        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Entrar">
    </form>
    <p>¿No tenés cuenta? <a href="register.php">Registrate aquí</a></p>
</body>
</html>
