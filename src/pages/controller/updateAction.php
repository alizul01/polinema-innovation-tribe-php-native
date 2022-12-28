<?php

include_once './../../../config/config.php';
session_start();

if (isset($_POST)) {

    $id = $_SESSION['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // old password
    $oldPassword = "SELECT password FROM users WHERE id = '$id'";

    if (!($password == $oldPassword)) {
        if (!($password == $confirmPassword)) {
            $_SESSION['error'] = 'Password tidak sama';
            header('location: ./../profile.php');
            die();
        }

        $password = md5($password);
    } else {
        $password = $oldPassword;
    }

    $isFileUploaded = false;

    if ($_FILES['foto']['name'] != '') {
        $isFileUploaded = true;
    }

    // image control
    if ($isFileUploaded) {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $size = $_FILES['foto']['size'];
        $filesAllowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = explode('.', $foto);
        $ext = strtolower(end($ext));
        $newName = uniqid();
        $newName .= '.';
        $newName .= $ext;

        if (!in_array($ext, $filesAllowed)) {
            $_SESSION['error'] = 'File yang diupload harus berupa gambar';
            header('location: ./../profile.php');
            die();
        } else if ($size > 1000000) {
            $_SESSION['error'] = 'Ukuran file terlalu besar';
            header('location: ./../profile.php');
            die();
        } else {
            move_uploaded_file($tmp, './../../img/profile/' . $newName);
        }

        $sql = "UPDATE user SET NAMA = '$nama', ALAMAT = '$alamat', NO_TELP = '$no_telp', FOTO = '$newName', EMAIL = '$email', PASSWORD = '$password' WHERE ID = '$id'";
    } else {
        $sql = "UPDATE user SET NAMA = '$nama', ALAMAT = '$alamat', NO_TELP = '$no_telp', EMAIL = '$email', PASSWORD = '$password' WHERE ID = '$id'";
    }
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['updateSuccess'] = true;
        header('location: ./../profile.php');
    } else {
        $_SESSION['updateFailed'] = true;
        header('location: ./../profile.php');
    }
}
