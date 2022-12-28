<?php

include_once './../../../config/config.php';
session_start();

if (isset($_POST)) {

    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['content'];
    $deskripsi_singkat = $deskripsi.substr(0, 100);
    $userid = $_SESSION['id'];

    // image control
    $thumbnail = $_FILES['thumbnail']['name'];
    $tmp = $_FILES['thumbnail']['tmp_name'];
    $size = $_FILES['thumbnail']['size'];
    $filesAllowed = ['jpg', 'jpeg', 'png', 'webp'];
    $ext = explode('.', $thumbnail);
    $ext = strtolower(end($ext));
    $newName = uniqid();
    $newName .= '.';
    $newName .= $ext;

    if (!in_array($ext, $filesAllowed)) {
        $_SESSION['error'] = 'File yang diupload harus berupa gambar';
        header('location: ./../create.php');
        die();
    } else if ($size > 2000000) {
        $_SESSION['error'] = 'Ukuran file terlalu besar';
        header('location: ./../create.php');
        die();
    } else {
        move_uploaded_file($tmp, './../../img/post/' . $newName);
    }

    $sql = "INSERT INTO idea_box (JUDUL, KATEGORI, DESKRIPSI, DESKRIPSI_SINGKAT, THUMBNAIL, ID) VALUES ('$judul', '$kategori', '$deskripsi', '$deskripsi_singkat', '$newName', '$userid')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['createSuccess'] = true;
        header('location: ./../create.php');
    } else {
        $_SESSION['createFailed'] = true;
        header('location: ./../create.php');
    }
}
