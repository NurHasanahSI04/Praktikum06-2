<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: 404.php");
    exit();
}

include_once 'header.php';
include_once 'sidebar.php';
require_once 'dbkoneksi.php';

$home = 'Home';
$title = 'Tambah Pasien';


if ($_SERVER("REQUEST_METHOD")== "POST"){

    $_kode = $_POST['kode']; // 1
    $_nama = $_POST['nama']; // 2
    $_tmp_lahir = $_POST['tmp_lahir']; // 3
    $_tgl_lahir = $_POST['tgl_lahir']; // 4
    $_gender = $_POST['gender']; // 5
    $_email = $_POST['email']; // 6
    $_alamat = $_POST['alamat'];// 7
    $_kelurahan = $_POST['kelurahan']; // 8
    // simpan data ke array
    $data = [$_kode, $_nama, $_tmp_lahir, $_tgl_lahir, $_gender, $_email, $_alamat, $_kelurahan];
    
    $_proses = $_POST['proses'];
    if($_proses == "Simpan"){ // cek apakah menekan tombol simpan di form
    // defninsi query sql insert
    $sql = "INSERT INTO pasien(kode, nama, tmp_lahir, tgl_lahir,gender, email, alamat, kelurahan_id)
    VALUES(? , ? , ? , ? , ? , ? , ? , ?)";
    // definisikan statement sql
    $stmt = $dbh->prepare($sql);
    // eksekusi statement sql
    $stmt->execute($data);
    
    // redirect page ke halaman data_pasien.php
    header('Location: data_pasien.php');
    }
}

?>


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?= $home ?></a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="data_pasien" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="data_pasien_info">
                                <thead>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1" aria-sort="ascending">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Kode</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Nama Pasien</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Alamat</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nomor = 1;
                                    foreach ($query as $row) {
                                    ?>
                                        <tr>
                                            <td class="dtr-control sorting_1" tabindex="0"><?= $nomor++ ?></td>
                                            <td><?= $row['kode'] ?></td>
                                            <td><?= $row['nama'] ?></td>
                                            <td><?= $row['alamat'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
include_once 'footer.php';
?>