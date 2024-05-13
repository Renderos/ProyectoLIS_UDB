<?php
session_start();
include 'db_config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (!empty($username) && !empty($password)) {
    
    $sql = "SELECT id, username, password FROM clients WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    
    if ($result->num_rows == 0) {
        $sql = "SELECT id, username, password FROM companies WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_type'] = ($stmt->num_rows == 1) ? 'company' : 'client';
            header("Location: welcome.php");
        } else {
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: login.php");
            exit();        }
    } else {
        $_SESSION['error'] = "Usuario no encontrado.";
        header("Location: login.php");
        exit();    }
} else {
    $_SESSION['error'] = "Por favor complete todos los campos.";
    header("Location: login.php");
    exit();}
?>
