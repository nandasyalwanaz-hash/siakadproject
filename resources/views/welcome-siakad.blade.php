<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SIAKAD Syalwaptw</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        body {
            background: radial-gradient(circle at 15% 20%, #123a7a 0%, #0a1e42 45%, #050f24 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .stage {
            position: relative;
            width: 100%;
            max-width: 1200px;
            min-height: 640px;
            margin: 2.5rem 1rem;
            border-radius: 22px;
            overflow: hidden;
            background: linear-gradient(135deg, #0a1e42 0%, #123a7a 55%, #1a4fa0 100%);
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        }

        /* ===== dekorasi geometris ===== */
        .deco { position: absolute; pointer-events: none; }
        .deco-circle-1 {
            width: 460px; height: 460px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.18);
            top: -160px; right: -120px;
        }
        .deco-circle-2 {
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(90,150,255,0.18);
            bottom: -120px; right: 60px;
        }
        .deco-circle-3 {
            width: 140px; height: 140px; border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.15);
            bottom: 40px; right: 340px;
        }
        .deco-line {
            width: 2px; height: 260px;
            background: rgba(255,255,255,0.12);
            top: -20px; left: 230px;
            transform: rotate(18deg);
        }
        .deco-line-2 {
            width: 2px; height: 260px;
            background: rgba(255,255,255,0.12);
            top: -20px; left: 265px;
            transform: rotate(18deg);
        }
        .deco-triangle {
            width: 0; height: 0;
            border-left: 90px solid transparent;
            border-right: 90px solid transparent;
            border-bottom: 150px solid rgba(255,255,255,0.06);
            top: 230px; left: 300px;
            transform: rotate(12deg);
        }
        .deco-capsule {
            width: 640px; height: 120px;
            background: linear-gradient(90deg, #4f8ef7, #79b7ff);
            border-radius: 60px;
            opacity: 0.35;
            top: 40%;
            left: 40%;
            transform: rotate(-38deg);
            filter: blur(1px);
        }

        /* ===== konten ===== */
        .content-row {
            position: relative;
            z-index: 2;
            min-height: 640px;
        }
        .welcome-col {
            padding: 4rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }
        .logo-mark {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 3rem;
        }
        .logo-mark i { font-size: 1.6rem; }
        .welcome-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
        }
        .accent-line {
            width: 60px; height: 4px;
            background: #79b7ff;
            border-radius: 3px;
            margin-bottom: 1.25rem;
        }
        .welcome-desc {
            color: rgba(255,255,255,0.75);
            max-width: 380px;
            margin-bottom: 1.75rem;
        }
        .stat-pills { display: flex; gap: 0.75rem; flex-wrap: wrap; }
        .stat-pill {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px;
            padding: 0.6rem 1rem;
            min-width: 96px;
        }
        .stat-pill .num { font-size: 1.35rem; font-weight: 700; color: #9fc7ff; }
        .stat-pill .lbl { font-size: 0.75rem; color: rgba(255,255,255,0.65); }

        /* ===== kartu login ===== */
        .login-col {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
        }
        .login-card {
            width: 100%;
            max-width: 340px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 18px;
            padding: 2.25rem 2rem;
            box-shadow: 0 20px 45px rgba(0,0,0,0.35);
        }
        .login-card h3 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .login-card label {
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.35rem;
        }
        .login-card .form-control {
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.25);
            color: #fff;
            border-radius: 10px;
            padding: 0.65rem 0.9rem;
        }
        .login-card .form-control::placeholder { color: rgba(255,255,255,0.5); }
        .login-card .form-control:focus {
            background: rgba(255,255,255,0.18);
            border-color: #79b7ff;
            box-shadow: 0 0 0 3px rgba(121,183,255,0.25);
            color: #fff;
        }
        .btn-signin {
            background: linear-gradient(90deg, #2d6ce8, #5aa4ff);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 0.7rem;
            border-radius: 10px;
            width: 100%;
            margin-top: 0.5rem;
        }
        .btn-signin:hover { filter: brightness(1.08); color: #fff; }

        @media (max-width: 767px) {
            .welcome-col { padding: 2.5rem 1.75rem 1rem; }
            .welcome-title { font-size: 2.1rem; }
            .login-col { padding: 1rem 1.75rem 2.5rem; }
        }
    </style>
</head>
<body>

<div class="stage">
    <div class="deco deco-circle-1"></div>
    <div class="deco deco-circle-2"></div>
    <div class="deco deco-circle-3"></div>
    <div class="deco deco-line"></div>
    <div class="deco deco-line-2"></div>
    <div class="deco deco-triangle"></div>
    <div class="deco deco-capsule"></div>

    <div class="row g-0 content-row">
        <div class="col-md-7 welcome-col">
            <div class="logo-mark">
                <i class="bi bi-mortarboard-fill"></i> Selamat Datang di SIAKAD
            </div>
            <div class="welcome-title">Welcome!</div>
            <div class="accent-line"></div>
            <p class="welcome-desc">
                Kelola operasional kampus lebih efektif. Pusat kontrol terintegrasi bagi Mahasiswa, Dosen, Operator, 
                dan Admin untuk tata kelola nilai, KRS, serta analisis akademik.
            </p>
                           <div class="stat-pills">
                <div class="stat-pill">
                    <div class="num">{{ $totalMahasiswa }}</div>
                    <div class="lbl">Mahasiswa</div>
                </div>
                <div class="stat-pill">
                    <div class="num">{{ $totalDosen }}</div>
                    <div class="lbl">Dosen</div>
                </div>
                <div class="stat-pill">
                    <div class="num">{{ $totalMataKuliah }}</div>
                    <div class="lbl">Mata Kuliah</div>
                </div>
            </div>
        </div>

        <div class="col-md-5 login-col">
            <div class="login-card">
                <h3>Sign in</h3>

                @if($errors->any())
                    <div class="alert alert-danger py-2 small">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="nama@email.com" required autofocus>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="btn btn-signin">Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
