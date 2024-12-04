<?php
// This assumes you're passing the current page's file name or a similar identifier for active state.
$current_page = basename($_SERVER['PHP_SELF']);
?>

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
    <li class="nav-item <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php echo ($current_page == 'surat_masuk.php' || $current_page == 'log_surat.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="<?php echo ($current_page == 'surat_masuk.php' || $current_page == 'log_surat.php') ? 'true' : 'false'; ?>"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Rekap Surat</span>
        </a>
        <div id="collapseTwo" class="collapse <?php echo ($current_page == 'surat_masuk.php' || $current_page == 'log_surat.php') ? 'show' : ''; ?>" 
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengarsipan</h6>
                <a class="collapse-item <?php echo ($current_page == 'surat_masuk.php') ? 'active' : ''; ?>" href="surat_masuk.php">Surat Masuk</a>
                <a class="collapse-item <?php echo ($current_page == 'log_surat.php') ? 'active' : ''; ?>" href="log_surat.php">Log Surat</a>
            </div>  
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php echo ($current_page == 'user.php' || $current_page == 'divisi.php') ? 'active' : ''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="<?php echo ($current_page == 'user.php' || $current_page == 'divisi.php') ? 'true' : 'false'; ?>"
            aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Manajemen</span>
        </a>
        <div id="collapseUtilities" class="collapse <?php echo ($current_page == 'user.php' || $current_page == 'divisi.php') ? 'show' : ''; ?>"
            aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu</h6>
                <a class="collapse-item <?php echo ($current_page == 'user.php') ? 'active' : ''; ?>" href="user.php">Pengguna Terdaftar</a>
                <a class="collapse-item <?php echo ($current_page == 'divisi.php') ? 'active' : ''; ?>" href="divisi.php">Divisi</a>
            </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->
