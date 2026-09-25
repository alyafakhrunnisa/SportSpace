<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
    <header class="navbar navbar-expand-lg navbar-dark shadow-sm bg-aesthetic sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo $base; ?>index.php">
                <i class="bi bi-controller me-1 text-warning"></i> SportSpace
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto gap-2 align-items-center">
                    <li class="nav-item"><a class="nav-link <?php echo ($title === 'Beranda') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($title === 'Daftar Arena') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>arena/list.php">Daftar Arena</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($title === 'Tambah Arena') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>arena/tambah.php">Tambah Arena</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($title === 'Daftar Member') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>member/list.php">Daftar Member</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo ($title === 'Tambah Member') ? 'active fw-semibold' : ''; ?>" href="<?php echo $base; ?>member/tambah.php">Tambah Member</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="container my-5">