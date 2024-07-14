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
$title = 'Data Pasien';

$sql = "SELECT * FROM pasien";
$query = $dbh->query($sql);
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
                            <a type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambah">Add New Data</a>
                            <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="tambahLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="app/config//addAction.php" method="post" name="add">
                                            <table border="0">
                                                <tr> 
                                                    <td>Kode</td>
                                                    <td><input class="form-control" type="text" name="location"></td>
                                                </tr>
                                                <tr> 
                                                    <td>Nama Pasien</td>
                                                    <td><input class="form-control" type="text" name="temperature"></td>
                                                </tr>
                                                <tr> 
                                                    <td>Alamat</td>
                                                    <td><input class="form-control" type="text" name="humidity"></td>
                                                </tr>
                                                <tr> 
                                                    <td>Email</td>
                                                    <td><input class="form-control" type="text" name="wind_speed"></td>
                                                </tr>
                                               
                                                <tr> 
                                                    <td></td>
                                                    <td class="d-flex">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input class="form-control btn btn-primary" type="submit" name="submit" value="Add">
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <table id="data_pasien" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="data_pasien_info">
                                <thead>
                                    <tr>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1" aria-sort="ascending">No</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Kode</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Nama Pasien</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Alamat</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Email</th>
                                        <th class="sorting" tabindex="0" aria-controls="data_pasien" rowspan="1" colspan="1">Action</th>
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
                                            <td>
                                                <a type="button" class="btn btn-success mb-2" href="app/config/edit.php?id=<?= $report['id'] ?>&type=edit">edit</a>
                                                <a type="button" class="btn btn-danger mb-2" href="app/config/delete.php?id=<?= $report['id'] ?>&delete=delete">delete</a>
                                            </td>
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