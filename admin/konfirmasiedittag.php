<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_tag'])) {
  $id_tag = $_SESSION['id_tag'];
  $tag = $_POST['tag'];

  if (empty($id_tag)) {
    header("Location:edittag.php?data=" . $id_tag . "&notif=editkosong");
  } else {
    $sql = "UPDATE `tag` SET `tag` = '$tag' WHERE `id_tag` = '$id_tag'";
    mysqli_query($koneksi, $sql);
    unset($_SESSION['id_tag']);
    header("Location:tag.php?notif=editberhasil");
  }
}
