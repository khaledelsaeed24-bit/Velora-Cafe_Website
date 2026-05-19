<?php
session_start();
require_once 'db_connect.php';
if (isset($_POST['submit'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: ../html/Home.html");
            exit();
        } else {
            echo "<script>alert('Incorrect Password!'); window.location.href='../html/index-login.html';</script>";
        }
    } else {
        echo "<script>alert('Email not found!'); window.location.href='../html/index-login.html';</script>";
    }
} else {
    header("Location: ../html/index-login.html");
    exit();
}
?>