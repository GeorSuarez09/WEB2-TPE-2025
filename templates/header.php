<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Uber Viajes</title>

    <!-- Base URL para rutas absolutas -->
    <base href="<?= BASE_URL ?>">

    <!-- Vincular CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
<header class="site-header">
    <div class="header-container">
        <h1 class="logo">🚖 Uber <span>Viajes</span></h1>
        <nav class="navbar">
            <a href="<?= BASE_URL ?>listar">Inicio</a>
            <a href="<?= BASE_URL ?>listar">Viajes</a>
            <a href="<?= BASE_URL ?>listarC">Conductores</a>
            <?php if (isset($_SESSION['USER_ID'])): ?>
                <a href="<?= BASE_URL ?>logout">Cerrar sesión (<?= htmlspecialchars($_SESSION['USER_NAME']) ?>)</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>login">Iniciar sesión</a>
            <?php endif; ?>



        </nav>
    </div>
</header>
