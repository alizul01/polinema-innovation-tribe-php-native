<?php 

include_once './../../../config/config.php';
session_start();
$id_idea = $_POST['id_idea'];

$sql = "DELETE FROM idea_box WHERE ID_IDEA = '$id_idea'";
$query = mysqli_query($conn, $sql);

if ($query) {
    $_SESSION['deleteSuccess'] = true;
    header('location: ./../myidea.php');
} else {
    $_SESSION['deleteFailed'] = true;
    header('location: ./../myidea.php');
}

?>