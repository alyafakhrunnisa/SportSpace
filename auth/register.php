<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: ../index.php');
    exit;
}
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - SportSpace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh; padding: 2rem 0;">
    <main class="container d-flex justify-content-center">
        <section class="card border-0 shadow-sm rounded-4 overflow-hidden" style="max-width: 500px; width: 100%;">
            <div class="p-4 text-white text-center" style="background-color: #5a7061;">
                <div class="mb-2">
                    <i class="bi bi-person-plus-fill text-warning" style="font-size: 2.5rem;"></i>
                </div>
                <h3 class="fw-bold m-0">Registrasi Akun</h3>
                <p class="mb-0 text-white-50 small mt-1">Daftarkan petugas atau admin baru</p>
            </div>
            
            <div class="card-body p-4 p-md-5 bg-white">
                <?php if ($flash): ?>
                    <div class="alert alert-<?php echo $flash['type'] === 'error' ? 'danger' : 'success'; ?> rounded-3 small fw-medium text-center">
                        <?php echo $flash['pesan']; ?>
                    </div>
                <?php endif; ?>

                <form action="proses_register.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">NAMA LENGKAP</label>
                        <input type="text" name="nama" class="form-control border-0 bg-light py-2 fw-medium" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">USERNAME</label>
                        <input type="text" name="username" class="form-control border-0 bg-light py-2 fw-medium" placeholder="Buat username unik" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">ROLE (HAK AKSES)</label>
                        <select name="role" class="form-select border-0 bg-light py-2 fw-medium" required>
                            <option value="petugas">Petugas</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">PASSWORD</label>
                        <input type="password" name="password" class="form-control border-0 bg-light py-2 fw-medium" placeholder="Buat password" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">KONFIRMASI PASSWORD</label>
                        <input type="password" name="konfirmasi_password" class="form-control border-0 bg-light py-2 fw-medium" placeholder="Ulangi password di atas" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn text-white rounded-pill px-4 py-3 w-100 fw-bold shadow-sm" style="background-color: #8fa396;">
                            <i class="bi bi-person-check me-2"></i> Daftarkan Akun
                        </button>
                    </div>
                    
                    <div class="text-center mt-4">
                        <a href="login.php" class="text-secondary text-decoration-none small fw-medium">Sudah punya akun? <span style="color: #5a7061;">Login di sini</span></a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>