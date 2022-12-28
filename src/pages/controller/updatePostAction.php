<?php

include_once './../../../config/config.php';
session_start();
$id_idea = $_POST['id'];
$oldData = "SELECT * FROM idea_box WHERE ID_IDEA = '$id_idea'";
$oldQuery = mysqli_query($conn, $oldData);
$oldData = mysqli_fetch_assoc($oldQuery);
if (isset($_POST)) {

    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['content'];
    $deskripsi_singkat = $deskripsi . substr(0, 100);

    // image control
    if (!(empty($_FILES['thumbnail']['name']))) {
        $thumbnail = $_FILES['thumbnail']['name'];
        $tmp = $_FILES['thumbnail']['tmp_name'];
        $size = $_FILES['thumbnail']['size'];
        $filesAllowed = ['jpg', 'jpeg', 'png', 'webp'];
        $ext = explode('.', $thumbnail);
        $ext = strtolower(end($ext));

        if (!in_array($ext, $filesAllowed)) {
            $_SESSION['error'] = 'File yang diupload harus berupa gambar';
            header('location: ./../editPost.php?id=' . $id_idea);
            die();
        } else if ($size > 1000000) {
            $_SESSION['error'] = 'Ukuran file terlalu besar';
            header('location: ./../editPost.php?id=' . $id_idea);
            die();
        }
    } else {
        $thumbnail = '';
    }
    $newName = uniqid();
    $newName .= '.';
    $newName .= $ext;

    if (empty($thumbnail)) {
        $newName = $oldData['THUMBNAIL'];
    } else {
        unlink('./../../../assets/img/' . $oldData['THUMBNAIL']);
        move_uploaded_file($tmp, './../../../assets/img/' . $newName);
    }

    $sql = "UPDATE idea_box SET JUDUL = '$judul', KATEGORI = '$kategori', DESKRIPSI = '$deskripsi', DESKRIPSI_SINGKAT = '$deskripsi_singkat', THUMBNAIL = '$newName' WHERE ID_IDEA = '$id_idea'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $_SESSION['updateSuccess'] = true;
        header('location: ./../editPost.php?id=' . $id_idea);
    } else {
        $_SESSION['updateFailed'] = true;
        header('location: ./../editPost.php?id=' . $id_idea);
    }
}
