<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acerca de nosotros</title>
    <link rel="icon" href="imgs/logo.png" type="image/x-icon">
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
        }

        .dropdown div:last-child {
            border-bottom: none;
        }

        .dropdown a {
            color: #ccc;
            text-decoration: none;
        }

        .sidebar {
            position: fixed;
            top: 60px;
            left: 0;
            width: 60px;
            height: calc(100% - 60px);
            background-color: #121212;
        }

        .content-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            height: calc(100vh - 60px);
            margin-left: 100px;
            padding: 20px;
            max-width: 600px;
        }

        .content-box h1 {
            margin-bottom: 20px;
        }

        .content-box p {
            line-height: 1.6;
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
            <div><a href="index.php">Iniciar sesión</a></div>
            <div><a href="register.php">Registrarse</a></div>
            <div><a href="acerca.php">Acerca de nosotros</a></div>
        </div>
    </div>

    <div class="sidebar"></div>

    <div class="content-box">
        <h1>Acerca de nosotros</h1>
        <p>
            Servijam es una aplicación web diseñada para la gestión de trabajos de impresión 3D.
            Su objetivo es facilitar a los usuarios el envío de archivos Gcode listos para imprimir,
            llevando un control centralizado y sencillo tanto para administradores como para usuarios finales.
        </p>
        <p>
            A través de esta plataforma, buscamos automatizar y simplificar el flujo de impresión,
            mejorando la organización de tareas, control de accesos y trazabilidad de trabajos.
        </p>
        <p>
            Este proyecto está en constante evolución y se adapta a las necesidades de servicios de impresión
            personalizados, tanto para centros educativos como empresas tecnológicas.
        </p>
    </div>

    <script>
        function toggleMenu() {
            const menu = document.getElementById("dropdown-menu");
            menu.style.display = (menu.style.display === "flex") ? "none" : "flex";
        }
    </script>

</body>
</html>
