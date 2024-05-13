<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicia sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Iniciar sesión</h1>  
        <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <div class="form-content">
            <form action="process_login.php" method="POST">
                <input type="text" name="username" placeholder="Usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar sesión</button>
                <p><a href="">¿Olvidaste tu contraseña?</a></p>
                <p><a href="register.html">Regístrate</a></p>
            </form>
        </div>
        <div class="form-image">
        </div>
    </div>
</body>
</html>
