<?php
session_start();
require __DIR__ . '/includes/auth.php';
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

// Menghitung data otomatis dari database
$totalArena = $pdo->query("SELECT COUNT(*) FROM arena")->fetchColumn();
$totalMember = $pdo->query("SELECT COUNT(*) FROM member")->fetchColumn();
$arenaDipakai = $pdo->query("SELECT COUNT(*) FROM arena WHERE status != 'Tersedia'")->fetchColumn();
?>

    <!-- Main Container disamakan max-width-nya dengan navbar -->
    <main class="container-fluid px-4 px-md-5 my-5" style="max-width: 1500px;">
        
        <!-- HEADER DASHBOARD -->
        <section class="card border-0 rounded-4 mb-5 overflow-hidden shadow-sm" style="background: linear-gradient(135deg, #4A6054 0%, #8FA396 100%); color: white;">
            <div class="card-body p-5 position-relative">
                <div class="z-1 position-relative">
                    <span class="badge bg-white text-aesthetic rounded-pill px-3 py-2 mb-4 shadow-sm fs-6" style="font-weight: 600; letter-spacing: 0.5px;">
                        <i class="bi bi-stars text-warning"></i> Dashboard Reservasi
                    </span>
                    <h1 class="display-5 fw-bold mb-3">Arena Hub Management 🏸🎱</h1>
                    <p class="mb-0 fs-5" style="opacity: 0.9; max-width: 700px; line-height: 1.6;">
                        Kelola ketersediaan lapangan, pantau reservasi meja, dan tingkatkan pengalaman bermain pelanggan dengan sistem manajemen arena modern.
                    </p>
                </div>
                <!-- Efek Lingkaran Abstrak -->
                <div class="position-absolute rounded-circle" style="background: rgba(255,255,255,0.1); width: 250px; height: 250px; top: -50px; right: -20px;"></div>
                <div class="position-absolute rounded-circle" style="background: rgba(255,255,255,0.05); width: 350px; height: 350px; bottom: -100px; right: 100px;"></div>
            </div>
        </section>

        <!-- MASTER CARD: RINGKASAN OPERASIONAL -->
        <section class="card border-0 shadow-sm rounded-4 mb-5 bg-white">
            <div class="card-body p-4 p-lg-5">
                
                <h4 class="mb-4 fw-bold text-aesthetic">Ringkasan Operasional</h4>
                
                <div class="row g-4 text-center">
                    
                    <!-- Kotak 1: Total Arena -->
                    <div class="col-6 col-lg-3">
                        <div class="card border-0 border-bottom border-4 border-aesthetic shadow-sm h-100 bg-light hover-lift">
                            <div class="card-body p-4 p-lg-5">
                                <i class="bi bi-grid-1x2-fill display-4 text-aesthetic mb-3 d-block"></i>
                                <h3 class="fs-5 text-secondary fw-semibold">Total Arena</h3>
                                <p class="display-3 fw-bold mb-0 text-aesthetic"><?php echo $totalArena; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak 2: Member Aktif -->
                    <div class="col-6 col-lg-3">
                        <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-light hover-lift" style="border-color: #8FA396 !important;">
                            <div class="card-body p-4 p-lg-5">
                                <i class="bi bi-people-fill display-4 mb-3 d-block" style="color: #8FA396;"></i>
                                <h3 class="fs-5 text-secondary fw-semibold">Member Aktif</h3>
                                <p class="display-3 fw-bold mb-0" style="color: #8FA396;"><?php echo $totalMember; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak 3: Sedang Dipakai -->
                    <div class="col-6 col-lg-3">
                        <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-light hover-lift" style="border-color: #D4A373 !important;">
                            <div class="card-body p-4 p-lg-5">
                                <i class="bi bi-play-circle-fill display-4 mb-3 d-block" style="color: #D4A373;"></i>
                                <h3 class="fs-5 text-secondary fw-semibold">Sedang Dipakai</h3>
                                <p class="display-3 fw-bold mb-0" style="color: #D4A373;"><?php echo $arenaDipakai; ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Kotak 4: Reservasi Hari Ini -->
                    <div class="col-6 col-lg-3">
                        <div class="card border-0 border-bottom border-4 shadow-sm h-100 bg-light hover-lift" style="border-color: #CB8A8A !important;">
                            <div class="card-body p-4 p-lg-5">
                                <i class="bi bi-calendar-event-fill display-4 mb-3 d-block" style="color: #CB8A8A;"></i>
                                <h3 class="fs-5 text-secondary fw-semibold">Reservasi Hari Ini</h3>
                                <p class="display-3 fw-bold mb-0" style="color: #CB8A8A;">12</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        
    </main>

<?php include __DIR__ . '/includes/footer.php'; ?>