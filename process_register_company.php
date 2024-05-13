<?php
session_start();
include 'db_config.php';

$company_name = $_POST['company_name'];
$nit = $_POST['nit'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

try {
    if (!empty($company_name) && !empty($nit) && !empty($address) && !empty($phone) && !empty($email) && !empty($username) && !empty($password)) {
        $sql = "SELECT username FROM clients WHERE username = ? UNION SELECT username FROM companies WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "El nombre de usuario ya está en uso.";
            header("Location: register-business.php");
            exit();
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO companies (company_name, nit, address, phone, email, username, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssss", $company_name, $nit, $address, $phone, $email, $username, $password_hash);
            $stmt->execute();
            $_SESSION['success'] = "Registro de empresa exitoso.";
            header("Location: register-business-success.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Por favor complete todos los campos.";
        header("Location: register-business.php");
        exit();
    }
} catch (mysqli_sql_exception $e) {
    $_SESSION['error'] = "El email ya está registrado.";
    header("Location: register-business.php");
    exit();
}
?>
