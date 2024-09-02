<?php
session_start();
include('../koneksi/koneksi.php');
$judul = $_POST['judul'];
$tgl = $_POST['tanggal'];
$isi = $_POST['isi'];

if (empty($judul)) {
  header("Location:tambahkonten.php?notif=tambahkosong&jenis=judul");
} else if (empty($tgl)) {
  header("Location:tambahkonten.php?notif=tambahkosong&jenis=tanggal");
} else if (empty($isi)) {
  header("Location:tambahkonten.php?notif=tambahkosong&jenis=isi");
} else {
  $ex = explode("-", $tgl);
  $hari = $ex[0];
  $bulan = $ex[1];
  $tahun = $ex[2];
  $tanggal = $tahun . '-' . $bulan . '-' . $hari;

  $sql = "INSERT INTO `konten`
  (`tanggal`, `judul`, `isi`)
  VALUES
  ('$tanggal', '$judul', '$isi')";
  // echo $sql
  mysqli_query($koneksi, $sql);
  $id_konten = mysqli_insert_id($koneksi);
  header("Location:konten.php?notif=tambahberhasil");
}
