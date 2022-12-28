<?php

include './../../../config/config.php';
session_start();

if (isset($_POST['nama'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['emailAlreadyRegistered'] = "Email sudah terdaftar";
        header("location: ./../register.php");
        exit();
    }

    if ($password == $password2) {
        $password = md5($password);
        $sql = "INSERT INTO user (nama, email, roles, password) VALUES ('$nama', '$email', 'user', '$password')";
        mysqli_query($conn, $sql);
        $_SESSION['registerSuccess'] = "Pendaftaran berhasil";
        header("location: ./../login.php");
    } else {
        $_SESSION['passwordNotMatch'] = "Password tidak sama";
        header("location: ./../register.php");
    }
} else {
    header("location: ./../register.php");
}