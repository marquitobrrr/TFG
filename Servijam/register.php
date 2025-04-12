<!DOCTYPE html>
<html>
<head>
    <title>Registro - Servidor de Impresión 3D</title>
</head>
<body>
    <h2>Crear cuenta</h2>
    <form action="process_register.php" method="post">
        <label>Nombre de usuario:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Email (opcional):</label><br>
        <input type="email" name="email"><br><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
