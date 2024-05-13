<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de empresa</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Registro de empresa</h1>  
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
        <form action="process_register_company.php" method="POST">
            <input type="text" name="company_name" placeholder="Nombre de tu empresa" required>
            <input type="text" name="nit" placeholder="NIT" required>
            <input type="text" name="address" placeholder="Dirección" required>
            <input type="text" name="phone" placeholder="Teléfono" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="text" name="username" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
    </div>
</body>
</html>
