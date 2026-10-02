<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek status login dan role untuk mengatur navbar dinamis
$sudahLogin = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$role = $_SESSION['role'] ?? 'petugas';
$nama_user = $_SESSION['nama'] ?? 'User';

$__root = dirname(__DIR__);
$__script = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__script, strlen($__root))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
$title = $page_title ?? 'SportSpace';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SportSpace | <?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
    <style>
        .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    
    <header class="navbar navbar-expand-lg navbar-dark shadow-sm bg-aesthetic sticky-top py-4">
        <!-- Container-fluid dengan max-width agar tidak mojok -->
        <div class="container-fluid px-4 px-md-5" style="max-width: 1500px;">
            
            <a class="navbar-brand fw-bold fs-4" href="<?php echo $base; ?>index.php">
                <i class="bi bi-controller me-2 text-warning fs-3"></i> SportSpace
            </a>
            
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto gap-3 align-items-center">
                    <li class="nav-item"><a class="nav-link fs-5 <?php echo ($title === 'Beranda') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>index.php">Beranda</a></li>
                    
                    <li class="nav-item"><a class="nav-link fs-5 <?php echo ($title === 'Daftar Arena') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>arena/list.php">Daftar Arena</a></li>
                    
                    <?php if ($sudahLogin && $role === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link fs-5 <?php echo ($title === 'Tambah Arena') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>arena/tambah.php">Tambah Arena</a></li>
                    <?php endif; ?>

                    <li class="nav-item"><a class="nav-link fs-5 <?php echo ($title === 'Daftar Member') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>member/list.php">Daftar Member</a></li>
                    
                    <?php if ($sudahLogin && $role === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link fs-5 <?php echo ($title === 'Tambah Member') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>member/tambah.php">Tambah Member</a></li>
                    <?php endif; ?>
                </ul>

                <div class="ms-lg-4 mt-3 mt-lg-0 d-flex align-items-center gap-3">
                    <?php if ($sudahLogin): ?>
                        <span class="text-white fw-medium fs-5"><i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($nama_user); ?></span>
                        <a href="<?php echo $base; ?>auth/logout.php" class="btn btn-outline-light rounded-pill px-4">Logout</a>
                    <?php else: ?>
                        <a href="<?php echo $base; ?>auth/login.php" class="btn btn-warning rounded-pill px-4 fw-bold">Login</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>