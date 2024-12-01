<?php
session_start();

include "../koneksi.php";

$result_surat_masuk = mysqli_query($conn, "SELECT * FROM surat_masuk");
$jml_surat_masuk = mysqli_num_rows($result_surat_masuk);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pengarsipan Surat</title>

    <!-- External Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                    <img src="../img/Kayuh_Baimbai.png" alt="Logo" style="width: 50px; height: auto;">
                </div>
                <div class="sidebar-brand-text mx-3">Pengarsipan Surat</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>Rekap Surat</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Pengarsipan</h6>
                        <a class="collapse-item active" href="surat_masuk.php">Surat Masuk</a>
                        <a class="collapse-item" href="log_surat.php">Log Surat</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Manajemen</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pengguna</h6>
                            <a class="collapse-item" href="user.php">Pengguna Terdaftar</a>
                            <a class="collapse-item" href="divisi.php">Divisi</a>
                        </div>
                    </div>
                </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Alerts -->                         
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->              
                 
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="index.php"><i class="bx bx-home-alt"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Surat Masuk</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                    <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-1">Surat Masuk</h5>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col text-end">
                            <a href="surat_masuk_tambah.php" class="btn btn-primary">
                                <i class="bx bx-plus"></i> Tambah Data
                            </a>
                        </div>
                    </div>
                </div>
                <hr>
                    <!-- Tabel Surat Masuk -->
                    <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
                            <table id="example2" class="table table-hover">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Perihal</th>
                                        <th>Divisi</th>
                                        <th>Kode Surat</th>
                                        <th>Asal Surat</th>
                                        <th>File Surat</th>
                                        <th>Catatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $no = 1; // Mulai nomor urut dari 1 
                                    while($row_surat_masuk = mysqli_fetch_assoc($result_surat_masuk)) { 
                                        // Ambil nama divisi berdasarkan id_divisi
                                        $divisi_query = mysqli_query($conn, "SELECT nama_divisi FROM divisi WHERE id_divisi = '".$row_surat_masuk['id_divisi']."'");
                                        $divisi_row = mysqli_fetch_assoc($divisi_query);
                                        $nama_divisi = $divisi_row ? $divisi_row['nama_divisi'] : 'Tidak Ditemukan';

                                        // Ambil kode surat berdasarkan id_kode_surat
                                        $kode_surat_query = mysqli_query($conn, "SELECT kode_surat FROM kode_surat WHERE id_kode_surat = '".$row_surat_masuk['id_kode_surat']."'");
                                        $kode_surat_row = mysqli_fetch_assoc($kode_surat_query);
                                        $kode_surat = $kode_surat_row ? $kode_surat_row['kode_surat'] : 'Tidak Ditemukan';

                                        // Ambil nama instansi berdasarkan id_asal_surat
                                        $asal_surat_query = mysqli_query($conn, "SELECT nama_instansi FROM asal_surat WHERE id_asal_surat = '".$row_surat_masuk['id_asal_surat']."'");
                                        $asal_surat_row = mysqli_fetch_assoc($asal_surat_query);
                                        $nama_instansi = $asal_surat_row ? $asal_surat_row['nama_instansi'] : 'Tidak Ditemukan';
                                ?>
                                <tr>
                                <td><?php echo $no++; ?></td> <!-- Menampilkan nomor urut otomatis -->
                                <td><?php echo $row_surat_masuk["no_surat"]?></td>
                                <td><?php echo $row_surat_masuk["tanggal_masuk"]?></td>
                                <td><?php echo $row_surat_masuk["perihal"]?></td>
                                <td><?php echo $nama_divisi?></td> <!-- Menampilkan nama divisi -->
                                <td><?php echo $kode_surat?></td> <!-- Menampilkan kode surat -->
                                <td><?php echo $nama_instansi?></td> <!-- Menampilkan nama instansi -->
                                <td><?php echo $row_surat_masuk["file_surat"] ? 'Ada' : 'Tidak Ada' ?></td> <!-- Menampilkan 'Ada' jika file_surat ada -->
                                <td><?php echo $row_surat_masuk["catatan"]?></td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="surat-masuk-edit.php?id=<?php echo $row_surat_masuk["id_surat"]?>" class="btn btn-sm btn-success"><i class="bx bx-pencil"></i> Edit</a>
                                            <a href="surat-masuk-hapus.php?id=<?php echo $row_surat_masuk["id_surat"]?>" class="btn btn-sm btn-danger" onClick="return confirm('Apakah anda yakin ingin menghapus data ini...?')"><i class="bx bx-trash"></i> Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    <!-- End of Tabel Surat Masuk -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Keluar?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Pilih "Logout" bila ingin keluar dari akun ini.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="../login.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

    </body>

</html>
