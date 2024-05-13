<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Registro de cliente</h1>
        <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?= $_SESSION['error']; ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= $_SESSION['success']; ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <form action="process_register_client.php" method="POST">
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="email" name="email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <input type="text" name="first_name" placeholder="Nombres" required>
            <input type="text" name="last_name" placeholder="Apellidos" required>
            <input type="text" name="dui" placeholder="DUI" required>
            <input type="date" name="birth_date" placeholder="Fecha de nacimiento" required>
            <button type="submit">Registrarme</button>
        </form>
    </div>
</body>
</html>
