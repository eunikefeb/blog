<?php
  include('../koneksi/koneksi.php');
  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
    $id_blog = $_GET['data'];
    //get cover
    $sql_f = "SELECT `cover` FROM `blog` WHERE `id_blog`='$id_blog'";
    $query_f = mysqli_query($koneksi,$sql_f);
    $jumlah_f = mysqli_num_rows($query_f);
    if($jumlah_f>0){
      while($data_f = mysqli_fetch_row($query_f)){
        $cover = $data_f[0];
        //menghapus cover
        unlink("cover/$cover");
      }
    }
    //hapus tag blog
    $sql_dh = "delete from `tag_blog` where `id_blog` = '$id_blog'";
    mysqli_query($koneksi,$sql_dh);
    //hapus data blog
    $sql_dm = "delete from `blog` where `id_blog` = '$id_blog'";
    mysqli_query($koneksi,$sql_dm);
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include("includes/header.php") ?>

  <?php include("includes/sidebar.php") ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fab fa-blogger"></i> Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Blog</h3>
                <div class="card-tools">
                  <a href="tambahblog.php" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Blog</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="" action="">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
                <?php if(!empty($_GET['notif'])){?>
                  <?php if($_GET['notif']=="tambahberhasil"){?>
                    <div class="alert alert-success" role="alert">
                      Data Berhasil Ditambahkan</div>
                  <?php } else if($_GET['notif']=="editberhasil"){?>
                    <div class="alert alert-success" role="alert">
                      Data Berhasil Diubah</div>
                  <?php } else if($_GET['notif']=="hapusberhasil"){?>
                    <div class="alert alert-success" role="alert">
                      Data Berhasil Dihapus</div>
                  <?php } ?>
                <?php }?>
              </div>
              <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Kategori</th>
                        <th width="30%">Judul</th>
                        <th width="20%">Tanggal</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      //menampilkan data blog
                      $sql_b = "SELECT `b`.`id_blog`, `b`.`Judul`,
                                `k`.`kategori_blog`, DATE_FORMAT(`tanggal`, '%d-%m-%Y')
                                FROM `blog` `b`
                                INNER JOIN `kategori_blog` `k`
                                ON `b`.`id_kategori_blog` = `k`.`id_kategori_blog`
                                ORDER BY `k`.`kategori_blog`, `b`.`Judul`";
                      $query_b = mysqli_query($koneksi,$sql_b);
                      $no = 1;
                      while($data_b = mysqli_fetch_row($query_b)){
                            $id_blog = $data_b[0];
                            $judul = $data_b[1];
                            $kategori_blog = $data_b[2];
                            $tanggal = $data_b[3];
                      ?>
                      <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $kategori_blog;?></td>
                        <td><?php echo $judul;?></td>
                        <td><?php echo $tanggal;?></td>
                        <td align="center">
                          <a href="editblog.php?data=<?php echo $id_blog;?>" class="btn btn-xs btn-info" title="Edit"><i class="fas fa-edit"></i></a>
                          <a href="detailblog.php?data=<?php echo $id_blog;?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                          <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $judul; ?>?'))
                                  window.location.href = 'blog.php?aksi=hapus&data=<?php echo $id_blog;?>&notif=hapusberhasil'" 
                                  class="btn btn-xs btn-warning"><i class="fas fa-trash" title="Hapus"></i></a>                         
                        </td>
                      </tr>
                      <?php $no++;}?>

                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("includes/footer.php") ?>

</div>
<!-- ./wrapper -->

<?php include("includes/script.php") ?>
</body>
</html>
