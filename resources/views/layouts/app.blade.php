<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SIAKAD – {{ session('role', 'Guest') }}</title>

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <style>
    :root { --sidebar-bg: #2c3a54; --sidebar-accent: #47b2e4; }
    * { box-sizing: border-box; margin: 0; padding: 0; }

    .sidebar {
      position: fixed; top: 0; left: 0; height: 100vh; width: 260px;
      background: var(--sidebar-bg); z-index: 1040;
      display: flex; flex-direction: column; transition: transform .3s ease;
    }
    .sidebar-brand {
      padding: 20px; border-bottom: 1px solid rgba(255,255,255,.1);
    }
    .sidebar-brand h5 {
      color: #fff; font-family: 'Poppins',sans-serif; font-weight: 700;
      font-size: .95rem; margin: 0;
    }
    .sidebar-brand h5 span { color: var(--sidebar-accent); }
    .role-tag {
      display: inline-block; margin-top: 6px; font-size: .7rem; font-weight: 600;
      padding: 2px 10px; border-radius: 20px; font-family: 'Poppins',sans-serif;
      text-transform: uppercase; letter-spacing: .05em;
    }
    .role-tag.admin     { background: rgba(71,178,228,.2); color: #47b2e4; }
    .role-tag.mahasiswa { background: rgba(40,167,69,.2);  color: #5dd68c; }
    .role-tag.dosen     { background: rgba(255,193,7,.2);  color: #ffc107; }
    .role-tag.operator  { background: rgba(220,53,69,.2);  color: #f77; }

    .sidebar-nav { padding: 10px 0; flex: 1; overflow-y: auto; }
    .sidebar-section-title {
      font-size: .68rem; font-weight: 600; text-transform: uppercase;
      letter-spacing: 1px; color: rgba(255,255,255,.35);
      padding: 12px 20px 5px; font-family: 'Poppins',sans-serif;
    }
    .sidebar-nav a {
      display: flex; align-items: center; gap: 10px; padding: 9px 20px;
      color: rgba(255,255,255,.75); text-decoration: none;
      font-family: 'Open Sans',sans-serif; font-size: .875rem;
      border-left: 3px solid transparent; transition: all .2s;
    }
    .sidebar-nav a:hover { color: var(--sidebar-accent); background: rgba(71,178,228,.08); border-left-color: var(--sidebar-accent); }
    .sidebar-nav a.active { color: var(--sidebar-accent); background: rgba(71,178,228,.14); border-left-color: var(--sidebar-accent); font-weight: 600; }
    .sidebar-nav a i { font-size: 1rem; width: 18px; flex-shrink: 0; }

    .sidebar-footer {
      padding: 14px 20px; border-top: 1px solid rgba(255,255,255,.08);
    }
    .sidebar-footer a {
      display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,.5);
      text-decoration: none; font-size: .85rem; transition: color .2s;
    }
    .sidebar-footer a:hover { color: #f77; }

    .topbar {
      position: fixed; top: 0; left: 260px; right: 0; height: 58px;
      background: var(--sidebar-bg); display: flex; align-items: center;
      padding: 0 24px; z-index: 1030; gap: 12px;
      border-bottom: 1px solid rgba(255,255,255,.06);
    }
    .topbar-title { color: #fff; font-family: 'Poppins',sans-serif; font-size: .9rem; font-weight: 500; }
    .topbar-right { margin-left: auto; display: flex; align-items: center; gap: 10px; }
    .topbar-user { color: rgba(255,255,255,.7); font-size: .82rem; font-family: 'Open Sans',sans-serif; }
    .sidebar-toggle { background: none; border: none; color: #fff; font-size: 1.25rem; cursor: pointer; display: none; padding: 4px 8px; }

    .main-content { margin-left: 260px; margin-top: 58px; min-height: calc(100vh - 58px); background: #f4f6f9; padding: 24px; }

    .alert-role { background: #fff3cd; border: 1px solid #ffc107; border-radius: 6px; padding: 10px 16px; margin-bottom: 16px; font-size: .85rem; color: #856404; }

    .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.45); z-index: 1039; }
    @media (max-width: 991px) {
      .sidebar { transform: translateX(-100%); }
      .sidebar.open { transform: translateX(0); }
      .sidebar-overlay.show { display: block; }
      .topbar { left: 0; }
      .main-content { margin-left: 0; }
      .sidebar-toggle { display: inline-flex; }
    }
  </style>
</head>
<body>

@php $role = session('role', 'Guest'); @endphp

<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand">
    <h5><span>&#9670;</span> SIAKAD</h5>
    <span class="role-tag {{ strtolower($role) }}">{{ $role }}</span>
  </div>

  <nav class="sidebar-nav">

    {{-- ── ADMIN: akses semua master & transaksi ── --}}
    @if($role === 'Admin')
      <div class="sidebar-section-title">Data Master</div>
      <a href="{{ url('/data-mahasiswa') }}" class="{{ request()->is('data-mahasiswa*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Mahasiswa
      </a>
      <a href="{{ url('/data-dosen') }}" class="{{ request()->is('data-dosen*') ? 'active' : '' }}">
        <i class="bi bi-person-badge-fill"></i> Dosen
      </a>
      <a href="{{ url('/data-mata-kuliah') }}" class="{{ request()->is('data-mata-kuliah*') ? 'active' : '' }}">
        <i class="bi bi-journal-bookmark-fill"></i> Mata Kuliah
      </a>

      <div class="sidebar-section-title">Akademik</div>
      <a href="{{ url('/data-krs') }}" class="{{ request()->is('data-krs*') ? 'active' : '' }}">
        <i class="bi bi-card-list"></i> KRS
      </a>
      <a href="{{ url('/data-jadwal') }}" class="{{ request()->is('data-jadwal*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Jadwal Kuliah
      </a>
      <a href="{{ url('/data-absensi') }}" class="{{ request()->is('data-absensi*') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-check-fill"></i> Absensi
      </a>
      <a href="{{ url('/data-nilai') }}" class="{{ request()->is('data-nilai*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-fill"></i> Nilai
      </a>
      <a href="{{ url('/data-fuzzy-hasil') }}" class="{{ request()->is('data-fuzzy-hasil*') || request()->is('create-fuzzy-hasil*') || request()->is('hasil-fuzzy*') ? 'active' : '' }}">
        <i class="bi bi-cpu-fill"></i> Evaluasi Fuzzy
      </a>
    @endif

    {{-- ── MAHASISWA: KRS & Nilai (read only) ── --}}
    @if($role === 'Mahasiswa')
      <div class="sidebar-section-title">Akademik Saya</div>
      <a href="{{ url('/data-krs') }}" class="{{ request()->is('data-krs*') ? 'active' : '' }}">
        <i class="bi bi-card-list"></i> Ambil KRS
      </a>
      <a href="{{ url('/data-nilai') }}" class="{{ request()->is('data-nilai*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-fill"></i> Lihat Nilai
      </a>
      <a href="{{ url('/data-absensi') }}" class="{{ request()->is('data-absensi*') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-check-fill"></i> Lihat Absensi
      </a>
      <a href="{{ url('/data-jadwal') }}" class="{{ request()->is('data-jadwal*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Jadwal Kuliah
      </a>
      <a href="{{ url('/data-fuzzy-hasil') }}" class="{{ request()->is('data-fuzzy-hasil*') || request()->is('hasil-fuzzy*') ? 'active' : '' }}">
        <i class="bi bi-cpu-fill"></i> Prediksi Kelulusan
      </a>
    @endif

    {{-- ── DOSEN: Nilai & Absensi ── (UAS) --}}
    @if($role === 'Dosen')
      <div class="sidebar-section-title">Pengajaran</div>
      <a href="{{ url('/data-nilai') }}" class="{{ request()->is('data-nilai*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-fill"></i> Input Nilai
      </a>
      <a href="{{ url('/data-absensi') }}" class="{{ request()->is('data-absensi*') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-check-fill"></i> Input Absensi
      </a>
      <a href="{{ url('/data-jadwal') }}" class="{{ request()->is('data-jadwal*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Jadwal Kuliah
      </a>
      <a href="{{ url('/data-fuzzy-hasil') }}" class="{{ request()->is('data-fuzzy-hasil*') || request()->is('create-fuzzy-hasil*') || request()->is('hasil-fuzzy*') ? 'active' : '' }}">
        <i class="bi bi-cpu-fill"></i> Evaluasi Fuzzy
      </a>
    @endif

    {{-- ── DASHBOARD (semua role) ── --}}
<a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
  <i class="bi bi-house-door-fill"></i> Dashboard
</a>

    {{-- ── OPERATOR: Data Akademik + Hak Akses ── --}}
    @if($role === 'Operator')
      <div class="sidebar-section-title">Master Data</div>
      <a href="{{ url('/data-mahasiswa') }}" class="{{ request()->is('data-mahasiswa*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Data Mahasiswa
      </a>
      <a href="{{ url('/data-mata-kuliah') }}" class="{{ request()->is('data-mata-kuliah*') ? 'active' : '' }}">
        <i class="bi bi-journal-bookmark-fill"></i> Mata Kuliah
      </a>

      <div class="sidebar-section-title">Akademik</div>
      <a href="{{ url('/data-krs') }}" class="{{ request()->is('data-krs*') ? 'active' : '' }}">
        <i class="bi bi-card-list"></i> Data KRS
      </a>
      <a href="{{ url('/data-jadwal') }}" class="{{ request()->is('data-jadwal*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Jadwal Kuliah
      </a>
      <a href="{{ url('/data-absensi') }}" class="{{ request()->is('data-absensi*') ? 'active' : '' }}">
        <i class="bi bi-clipboard2-check-fill"></i> Absensi
      </a>
      <a href="{{ url('/data-nilai') }}" class="{{ request()->is('data-nilai*') ? 'active' : '' }}">
        <i class="bi bi-bar-chart-fill"></i> Nilai
      </a>
      <a href="{{ url('/data-fuzzy-hasil') }}" class="{{ request()->is('data-fuzzy-hasil*') || request()->is('create-fuzzy-hasil*') || request()->is('hasil-fuzzy*') ? 'active' : '' }}">
        <i class="bi bi-cpu-fill"></i> Evaluasi Fuzzy
      </a>

      <div class="sidebar-section-title">Manajemen Sistem</div>
      <a href="{{ url('/hak-akses') }}" class="{{ request()->is('hak-akses*') ? 'active' : '' }}">
        <i class="bi bi-shield-lock-fill"></i> Kelola Hak Akses
      </a>
    @endif

  </nav>

  <div class="sidebar-footer">
    <a href="{{ url('/logout') }}">
      <i class="bi bi-box-arrow-left"></i> Logout
    </a>
  </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="topbar">
  <button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>
  <p class="topbar-title">Sistem Informasi Akademik</p>
  <div class="topbar-right">
    <span class="topbar-user">
      <i class="bi bi-person-circle"></i>
      {{ auth()->user()->name ?? 'Guest' }}
    </span>
  </div>
</div>

<main class="main-content">
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif
  @yield('content')
</main>

<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script>
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const toggle  = document.getElementById('sidebarToggle');
  toggle.addEventListener('click', () => { sidebar.classList.toggle('open'); overlay.classList.toggle('show'); });
  overlay.addEventListener('click', () => { sidebar.classList.remove('open'); overlay.classList.remove('show'); });
</script>
</body>
</html>
