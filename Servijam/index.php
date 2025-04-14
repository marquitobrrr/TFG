<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Servijam | Inicio de sesión</title>
    <link rel="icon" href="imgs/logo.png" type="image/png">
    <style>
        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #ffffff;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #121212;
            padding: 10px 20px;
            height: 60px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            height: 40px;
        }

        .title {
            margin-left: 20px;
            margin-right: auto;
            font-size: 18px;
        }

        .menu-button {
            font-size: 30px;
            cursor: pointer;
            padding: 0 10px;
        }

        .dropdown {
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: #2a2a2a;
            border: 1px solid #444;
            display: none;
            flex-direction: column;
            z-index: 1000;
            border-radius: 5px;
        }

        .dropdown div {
            padding: 10px 20px;
            border-bottom: 1px solid #444;
            color: #ccc;
        }

        .dropdown div:last-child {
            border-bottom: none;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 60px;
            height: calc(100% - 60px);
            background-color: #121212;
        }

        .login-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 60px);
            margin-left: 60px;
        }

        .login-form {
            background-color: #2e2e2e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px #000;
            width: 400px;
        }
        
        .login-form label {
             margin-top: 15px;
            display: block;
            font-size: 14px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            background-color: #1e1e1e;
            border: none;
            color: #fff;
            border-bottom: 2px solid #555;
        }

        .login-form input[type="submit"] {
            background-color: #444;
            border: none;
            cursor: pointer;
            margin-top: 20px;
        }

        .login-form input[type="submit"]:hover {
            background-color: #666;
        }

        .login-form a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="topbar">
        <div class="logo">
            <img src="imgs/logo.jpg" alt="Logo">
        </div>
        <div class="title">servijam</div>
        <div class="menu-button" onclick="toggleMenu()">⋮</div>
        <div class="dropdown" id="dropdown-menu">
            <div onclick="location.href='index.php'">Iniciar sesión</div>
            <div onclick="location.href='register.php'">Registrarse</div>
            <div onclick="location.href='about.php'">Acerca de nosotros</div>
        </div>

    </div>

    <div class="sidebar"></div>

    <div class="login-box">
        <form class="login-form" action="login.php" method="post">
            <label>Usuario o Email:</label>
            <input type="text" name="user_input" required>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
            <input type="submit" value="Entrar">
            <a href="register.php">¿No tienes cuenta? Registrate aquí</a>
        </form>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("dropdown-menu");
            menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
        }
    </script>

</body>
</html>
