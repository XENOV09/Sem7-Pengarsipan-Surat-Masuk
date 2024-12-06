<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

//url base, ubah gasan laptop kena
$base_url = "http://localhost/pengarsipan/";

$id_user = $_SESSION['id_user'];
$id_surat = $_GET['id'];

// Fetch current data for the surat masuk to edit
$query = "SELECT * FROM surat_masuk WHERE id_surat = '$id_surat'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    // Redirect to surat_masuk page if data not found
    header("Location: surat_masuk.php");
    exit();
}

$data_surat = mysqli_fetch_assoc($result);
$file_error = "";  // Initialize an empty error message

// Fetch data for dropdowns
$divisi_query = mysqli_query($conn, "SELECT * FROM divisi");
$kode_surat_query = mysqli_query($conn, "SELECT * FROM kode_surat");
$asal_surat_query = mysqli_query($conn, "SELECT * FROM asal_surat");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_surat = $_POST['no_surat'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $perihal = $_POST['perihal'];
    $id_divisi = $_POST['id_divisi'];
    $id_kode_surat = $_POST['id_kode_surat'];
    $id_asal_surat = $_POST['id_asal_surat'];
    $catatan = $_POST['catatan'];
    $file_surat = $_FILES['file_surat']['name'];

    // Initialize file error message as empty
    $file_error = "";

    // Update file if a new one is uploaded
    if ($file_surat) {
        $target_dir = "../files/";

        // Get file extension
        $file_extension = strtolower(pathinfo($file_surat, PATHINFO_EXTENSION));

        // Allowed file types
        $allowed_extensions = ['pdf', 'png', 'jpg', 'jpeg'];

        // Check file type
        if (!in_array($file_extension, $allowed_extensions)) {
            $file_error = "Hanya File PDF, PNG, JPG, JPEG yang diperbolehkan!";
        }

        // Check file size (max 5MB)
        elseif ($_FILES['file_surat']['size'] > 5 * 1024 * 1024) { // 5MB in bytes
            $file_error = 'Ukuran file melebihi 5MB.';
        }

        // If no errors, process the file upload
        if (!$file_error) {
            // Randomize the file name
            $random_name = uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $random_name;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['file_surat']['tmp_name'], $target_file)) {
                // Update $file_surat with the full URL
                $file_surat = $base_url . "files/" . $random_name;
            } else {
                $file_surat = null; // Reset if upload failed
            }
        }
    } else {
        // If no file is uploaded, keep the existing file
        $file_surat = $data_surat['file_surat'];  // Retain the current file URL
    }

    // Update data in the database
    if (!$file_error) {
        $update_query = "UPDATE surat_masuk 
                         SET no_surat = '$no_surat', 
                             tanggal_masuk = '$tanggal_masuk', 
                             perihal = '$perihal', 
                             id_divisi = '$id_divisi', 
                             id_kode_surat = '$id_kode_surat', 
                             id_asal_surat = '$id_asal_surat', 
                             file_surat = '$file_surat', 
                             catatan = '$catatan' 
                         WHERE id_surat = '$id_surat'";

        // Execute the query and redirect on success
        if (mysqli_query($conn, $update_query)) {
            header("Location: surat_masuk.php");
            exit();
        } else {
            // Error in updating, silently fail (no visible error message)
            // Could log the error to a file or silently handle the issue
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Surat Masuk</title>
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
                <?php include "header.php" ?>

                <!-- End of Topbar --> 

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <!-- Page Heading -->
                        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                            <div>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0 p-0">
                                        <li class="breadcrumb-item"><a href="surat_masuk.php">Surat Masuk</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Edit Surat Masuk</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Surat Masuk</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat</label>
                                    <input type="text" class="form-control" id="no_surat" name="no_surat" value="<?php echo $data_surat['no_surat']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_masuk">Tanggal Masuk</label>
                                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?php echo $data_surat['tanggal_masuk']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <textarea class="form-control" id="perihal" name="perihal" rows="3" required><?php echo $data_surat['perihal']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_divisi">Divisi</label>
                                    <select class="form-control" id="id_divisi" name="id_divisi" required>
                                        <option value="">Pilih Divisi</option>
                                        <?php while ($row = mysqli_fetch_assoc($divisi_query)) : ?>
                                            <option value="<?php echo $row['id_divisi']; ?>" <?php echo ($data_surat['id_divisi'] == $row['id_divisi']) ? 'selected' : ''; ?>>
                                                <?php echo $row['nama_divisi']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_kode_surat">Kode Surat</label>
                                    <select class="form-control" id="id_kode_surat" name="id_kode_surat" required>
                                        <option value="">Pilih Kode Surat</option>
                                        <?php while ($row = mysqli_fetch_assoc($kode_surat_query)) : ?>
                                            <option value="<?php echo $row['id_kode_surat']; ?>" <?php echo ($data_surat['id_kode_surat'] == $row['id_kode_surat']) ? 'selected' : ''; ?>>
                                                <?php echo $row['kode_surat']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_asal_surat">Asal Surat</label>
                                    <select class="form-control" id="id_asal_surat" name="id_asal_surat" required>
                                        <option value="">Pilih Asal Surat</option>
                                        <?php while ($row = mysqli_fetch_assoc($asal_surat_query)) : ?>
                                            <option value="<?php echo $row['id_asal_surat']; ?>" <?php echo ($data_surat['id_asal_surat'] == $row['id_asal_surat']) ? 'selected' : ''; ?>>
                                                <?php echo $row['nama_instansi']; ?>
                                            </option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="3"><?php echo $data_surat['catatan']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="file_surat">File Surat</label>
                                    <input type="file" class="form-control-file" id="file_surat" name="file_surat" accept=".pdf,.png,.jpg,.jpeg">
                                    <div class="form-text">Hanya File PDF, PNG, JPG, JPEG. Ukuran Maksimum: 5MB</div>
                                    <?php if ($data_surat['file_surat']): ?>
                                        <p>File saat ini: <a href="<?php echo $data_surat['file_surat']; ?>" target="_blank">Lihat File</a></p>
                                    <?php endif; ?>
                                    <?php if ($file_error): ?>
                                        <small class="text-danger"><?= $file_error ?></small>
                                    <?php endif; ?>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Page Content -->
            </div>
            <!-- End Main Content -->
        </div>
        <!-- End Content Wrapper -->
    </div>
    <!-- End Page Wrapper -->
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
    <script src="../js/app.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <!-- Buttons Extension CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Buttons Extension JS -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
</body>
</html>
