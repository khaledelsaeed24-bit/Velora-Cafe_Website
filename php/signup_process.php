<?php
session_start();
require_once 'db_connect.php';
if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='../html/index-signup.html';</script>";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Account created successfully! Please login.'); window.location.href='../html/index-login.html';</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    header("Location: ../html/index-signup.html");
    exit();
}
?>