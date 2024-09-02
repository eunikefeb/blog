<?php
session_start();
include('../koneksi/koneksi.php');
if (isset($_SESSION['id_konten'])) {
  $id_konten = $_SESSION['id_konten'];
  $judul = $_POST['judul'];
  $tgl = $_POST['tanggal'];
  $isi = $_POST['isi'];

  if (empty($judul)) {
    header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=judul");
  } else if (empty($tgl)) {
    header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=tanggal");
  } else if (empty($isi)) {
    header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=isi");
  } else {
    $ex = explode("-", $tgl);
    $hari = $ex[0];
    $bulan = $ex[1];
    $tahun = $ex[2];
    $tanggal = $tahun . '-' . $bulan . '-' . $hari;

    $sql = "UPDATE `konten` SET
    `judul` = '$judul', `isi` = '$isi', `tanggal` = '$tanggal'
    WHERE `id_konten` = '$id_konten'";
    mysqli_query($koneksi, $sql);
    //echo $sql
  }
  header("Location:konten.php?notif=editberhasil");
}
