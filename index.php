<?php
session_start();
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

// Menghitung jumlah data asli dari database
$totalArena = $pdo->query("SELECT COUNT(*) FROM arena")->fetchColumn();
$totalMember = $pdo->query("SELECT COUNT(*) FROM member")->fetchColumn();
?>
    <main class="container my-5">
        <section class="card border-0 rounded-4 mb-5 overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #4A6054 0%, #8FA396 100%); color: white;">
            <div class="card-body p-5 position-relative">
                <div class="z-1 position-relative">
                    <span class="badge bg-white text-aesthetic rounded-pill px-3 py-2 mb-3 shadow-sm" style="font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-stars text-warning"></i> Dashboard Reservasi
                    </span>
                    <h2 class="fw-bold mb-3" style="font-size: 2.5rem;">Arena Hub Management 🏸🎱</h2>
                    <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; line-height: 1.6;">
                        Kelola ketersediaan lapangan, pantau reservasi meja, dan tingkatkan pengalaman bermain pelanggan dengan sistem manajemen arena modern.
                    </p>
                </div>
                <div class="position-absolute rounded-circle" style="background: rgba(255,255,255,0.1); width: 200px; height: 200px; top: -50px; right: -20px;"></div>
                <div class="position-absolute rounded-circle" style="background: rgba(255,255,255,0.05); width: 300px; height: 300px; bottom: -100px; right: 100px;"></div>
            </div>
        </section>

        <section class="mb-5">
            <h5 class="mb-3 fw-bold text-aesthetic">Ringkasan Operasional</h5>
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="card border-0 border-bottom border-4 border-aesthetic shadow-sm h-100 bg-white hover-lift">
                        <div class="card-body p-4">
                            <i class="bi bi-grid-1x2-fill fs-1 text-aesthetic mb-2 d-block"></i>
                            <h3 class="h6 text-secondary fw-semibold">Total Arena</h3>
                            <p class="fs-2 fw-bold mb-0 text-aesthetic"><?php echo $totalArena; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-white hover-lift" style="border-color: #8FA396 !important;">
                        <div class="card-body p-4">
                            <i class="bi bi-people-fill fs-1 mb-2 d-block" style="color: #8FA396;"></i>
                            <h3 class="h6 text-secondary fw-semibold">Member Aktif</h3>
                            <p class="fs-2 fw-bold mb-0" style="color: #8FA396;"><?php echo $totalMember; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-white hover-lift" style="border-color: #D4A373 !important;">
                        <div class="card-body p-4">
                            <i class="bi bi-play-circle-fill fs-1 mb-2 d-block" style="color: #D4A373;"></i>
                            <h3 class="h6 text-secondary fw-semibold">Sedang Dipakai</h3>
                            <p class="fs-2 fw-bold mb-0" style="color: #D4A373;">4</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-white hover-lift" style="border-color: #CB8A8A !important;">
                        <div class="card-body p-4">
                            <i class="bi bi-calendar-event-fill fs-1 mb-2 d-block" style="color: #CB8A8A;"></i>
                            <h3 class="h6 text-secondary fw-semibold">Reservasi Hari Ini</h3>
                            <p class="fs-2 fw-bold mb-0" style="color: #CB8A8A;">12</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php include __DIR__ . '/includes/footer.php'; ?>