<?php
session_start();
include 'db_config.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$dui = $_POST['dui'];
$birth_date = $_POST['birth_date'];

try {
    if (!empty($username) && !empty($email) && !empty($password) && !empty($first_name) && !empty($last_name) && !empty($dui) && !empty($birth_date)) {
        $sql = "SELECT username FROM clients WHERE username = ? UNION SELECT username FROM companies WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "El nombre de usuario ya está en uso.";
            header("Location: register-client.php");
            exit();
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO clients (username, email, password, first_name, last_name, dui, birth_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $username, $email, $password_hash, $first_name, $last_name, $dui, $birth_date);
            $stmt->execute();
            $_SESSION['success'] = "Registro de cliente exitoso.";
            header("Location: register-client-success.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Por favor complete todos los campos.";
        header("Location: register-client.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "El email ya está registrado.";
    header("Location: register-client.php");
    exit();
}
?>
