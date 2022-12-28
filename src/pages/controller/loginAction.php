<?php

include './../../../config/config.php';
session_start();

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if (md5($password) == $row['PASSWORD']) {
            $_SESSION['loginSuccess'] = true;
            $_SESSION['nama'] = $row['NAMA'];
            $_SESSION['email'] = $row['EMAIL'];
            $_SESSION['roles'] = $row['ROLES'];
            $_SESSION['id'] = $row['ID'];

            header("location: ./../../../index.php");
        } else {
            $_SESSION['error'] = 'Password salah';
            header("location: ./../login.php");
        }
    } else {
        $_SESSION['error'] = 'Email tidak terdaftar';
        header("location: ./../login.php");
    }
} else {
    $_SESSION['error'] = 'Terjadi kesalahan';
    header("location: ./../login.php");
}
