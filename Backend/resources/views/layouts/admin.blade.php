<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Dashboard') — Magezi ga Lawyer</title>
  <meta name="description" content="Admin portal for managing cases, users, and support tickets for Magezi ga Lawyer." />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

  <style>
    /* ── RESET & TOKENS ────────────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --primary:      #0f4d85;
      --primary-lt:   #1d7fd8;
      --accent:       #0c6f57;
      --danger:       #b8232f;
      --purple:       #8b5cf6;
      --amber:        #f59e0b;
      --cyan:         #06b6d4;
      --bg:           #0d1117;
      --bg-surface:   #161b22;
      --bg-card:      #1c2333;
      --bg-hover:     #21293a;
      --text:         #e6edf3;
      --text-soft:    #8b949e;
      --text-muted:   #6e7681;
      --border:       rgba(255,255,255,0.08);
      --radius:       16px;
      --radius-sm:    10px;
      --shadow:       0 8px 32px rgba(0,0,0,0.4);
      --transition:   0.2s ease;
      --font:         'Inter', system-ui, -apple-system, sans-serif;
    }

    html, body { height: 100%; font-family: var(--font); background: var(--bg); color: var(--text); }

    /* ── LAYOUT ────────────────────────────────────────────────────────────── */
    #app { display: flex; min-height: 100vh; }

    /* ── SIDEBAR ───────────────────────────────────────────────────────────── */
    .sidebar {
      width: 240px; flex-shrink: 0;
      background: var(--bg-surface);
      border-right: 1px solid var(--border);
      display: flex; flex-direction: column;
      position: sticky; top: 0; height: 100vh;
      transition: transform var(--transition);
      z-index: 100;
    }
    .sidebar-brand {
      display: flex; align-items: center; gap: 12px;
      padding: 24px 20px; border-bottom: 1px solid var(--border);
    }
    .brand-logo {
      width: 40px; height: 40px;
      background: linear-gradient(135deg, var(--primary), var(--primary-lt));
      border-radius: 10px; display: grid; place-items: center;
      font-weight: 800; font-size: 0.9rem; color: white; flex-shrink: 0;
    }
    .brand-name { margin: 0; font-weight: 700; font-size: 0.88rem; line-height: 1.2; }
    .brand-sub  { margin: 0; font-size: 0.73rem; color: var(--text-muted); }

    .sidebar-nav { flex: 1; padding: 12px 10px; display: flex; flex-direction: column; gap: 4px; }

    .nav-btn {
      display: flex; align-items: center; gap: 10px;
      width: 100%; padding: 10px 12px;
      border: 1px solid transparent; border-radius: var(--radius-sm);
      background: transparent; color: var(--text-soft);
      font: 500 0.9rem/1 var(--font); cursor: pointer;
      transition: all var(--transition); text-align: left;
      text-decoration: none;
    }
    .nav-btn:hover  { background: var(--bg-hover); color: var(--text); }
    .nav-btn.active {
      background: linear-gradient(135deg, rgba(15,77,133,.25), rgba(15,77,133,.15));
      color: #60a5fa; border-color: rgba(15,77,133,.3);
    }
    .nav-icon { width: 18px; height: 18px; flex-shrink: 0; display: grid; place-items: center; }
    .nav-icon svg { width: 18px; height: 18px; }

    .sidebar-footer { padding: 16px 20px; border-top: 1px solid var(--border); }
    .back-link { color: var(--text-soft); text-decoration: none; font-size: 0.85rem; display: block; transition: color var(--transition); }
    .back-link:hover { color: var(--text); }

    .sidebar-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,0.5); z-index: 99;
    }

    /* ── MAIN AREA ─────────────────────────────────────────────────────────── */
    .main { flex: 1; display: flex; flex-direction: column; min-width: 0; }

    /* ── TOPBAR ────────────────────────────────────────────────────────────── */
    .topbar {
      position: sticky; top: 0; z-index: 50;
      background: rgba(13,17,23,.92); backdrop-filter: blur(16px);
      border-bottom: 1px solid var(--border);
      padding: 0 24px; height: 64px;
      display: flex; align-items: center; gap: 16px;
    }
    .menu-toggle {
      display: none; background: none; border: none;
      color: var(--text); font-size: 1.3rem; cursor: pointer; padding: 4px 8px;
    }
    .topbar-left  { flex: 1; display: flex; align-items: center; gap: 12px; }
    .topbar-title { margin: 0; font-size: 1.15rem; font-weight: 700; }
    .topbar-right { display: flex; align-items: center; gap: 8px; }

    .api-badge {
      font-size: 0.72rem; font-weight: 600; padding: 3px 10px;
      border-radius: 999px; letter-spacing: .03em;
    }
    .api-badge.online  { background: rgba(12,111,87,.2);  color: #34d399; border: 1px solid rgba(12,111,87,.4); }
    .api-badge.offline { background: rgba(245,158,11,.15); color: #fbbf24; border: 1px solid rgba(245,158,11,.3); }

    .icon-btn {
      width: 38px; height: 38px; border-radius: 10px;
      border: 1px solid var(--border); background: var(--bg-card);
      color: var(--text-soft); cursor: pointer;
      display: grid; place-items: center; transition: all var(--transition);
    }
    .icon-btn svg { width: 16px; height: 16px; }
    .icon-btn:hover { color: var(--text); border-color: rgba(255,255,255,.15); }

    .admin-avatar {
      width: 38px; height: 38px; border-radius: 10px;
      background: linear-gradient(135deg, var(--primary), var(--primary-lt));
      display: grid; place-items: center;
      font-weight: 700; font-size: 0.8rem; color: white;
    }

    /* ── CONTENT AREA ──────────────────────────────────────────────────────── */
    .content { flex: 1; padding: 28px 28px 48px; overflow-x: hidden; }

    /* ── LOADING BAR ───────────────────────────────────────────────────────── */
    #loading-bar {
      position: fixed; top: 0; left: 0; width: 100%; height: 3px;
      background: linear-gradient(90deg, var(--primary), #60a5fa, var(--primary));
      background-size: 200% 100%;
      animation: loadslide 1.2s linear infinite;
      z-index: 9999; display: none;
    }
    @keyframes loadslide { 0%{background-position:200% 0} 100%{background-position:-200% 0} }
    @keyframes spin       { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
    .spinning { animation: spin 1s linear infinite; display: inline-block; }

    /* ── RESPONSIVE ────────────────────────────────────────────────────────── */
    @media (max-width: 900px) {
      .sidebar {
        position: fixed; left: 0; top: 0; bottom: 0;
        transform: translateX(-100%);
      }
      .sidebar.open { transform: translateX(0); }
      .sidebar-overlay.open { display: block; }
      .menu-toggle { display: block; }
      .charts-row { grid-template-columns: 1fr; }
      .content { padding: 20px 16px 40px; }
    }
    @media (max-width: 640px) {
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .users-grid { grid-template-columns: 1fr; }
    }

    @yield('styles')
  </style>
</head>

<body>
<div id="loading-bar"></div>

<div id="app">

  <!-- ── SIDEBAR ───────────────────────────────────────────────────────────── -->
  <aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
      <div class="brand-logo">MG</div>
      <div>
        <p class="brand-name">Magezi ga Lawyer</p>
        <p class="brand-sub">Admin Panel</p>
      </div>
    </div>

    <nav class="sidebar-nav">
      <a href="{{ route('admin.dashboard') }}" class="nav-btn {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
        </span>
        Overview
      </a>
      <a href="{{ route('admin.cases') }}" class="nav-btn {{ request()->routeIs('admin.cases') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
          </svg>
        </span>
        Cases
      </a>
      <a href="{{ route('admin.team') }}" class="nav-btn {{ request()->routeIs('admin.team') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </span>
        Team
      </a>
      <a href="{{ route('admin.tickets') }}" class="nav-btn {{ request()->routeIs('admin.tickets') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
          </svg>
        </span>
        Tickets
      </a>
      <a href="{{ route('admin.practiceAreas') }}" class="nav-btn {{ request()->routeIs('admin.practiceAreas') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20"/>
          </svg>
        </span>
        Practice Areas
      </a>
      <a href="{{ route('admin.siteSettings') }}" class="nav-btn {{ request()->routeIs('admin.siteSettings') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
          </svg>
        </span>
        Site Settings
      </a>
      <a href="{{ route('admin.heroSlides') }}" class="nav-btn {{ request()->routeIs('admin.heroSlides') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
            <circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
          </svg>
        </span>
        Home Photos
      </a>
      <a href="{{ route('admin.acts') }}" class="nav-btn {{ request()->routeIs('admin.acts') ? 'active' : '' }}">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </span>
        Legal Acts
      </a>
    </nav>

    <div class="sidebar-footer">
      <a href="http://localhost:5173" class="back-link" id="back-to-site">← Back to site</a>
    </div>
  </aside>

  <div class="sidebar-overlay" id="overlay"></div>

  <!-- ── MAIN ──────────────────────────────────────────────────────────────── -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <button class="menu-toggle" id="menu-toggle" aria-label="Toggle sidebar">☰</button>
      <div class="topbar-left">
        <h1 class="topbar-title" id="page-title">@yield('title', 'Dashboard')</h1>
        <span class="api-badge online" id="api-badge">● API Live</span>
      </div>
      <div class="topbar-right">
        <button class="icon-btn" onclick="window.location.reload()" title="Refresh data" aria-label="Refresh">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/>
            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
          </svg>
        </button>
        <button class="icon-btn" aria-label="Notifications">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
          </svg>
        </button>
        <div class="admin-avatar" aria-label="Admin user">AD</div>
      </div>
    </header>

    <!-- Content -->
    <main class="content">
        @yield('content')
    </main>
  </div><!-- /.main -->
</div><!-- /#app -->

<script>
  /* Mobile sidebar toggle */
  document.getElementById('menu-toggle').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('open');
  });
  document.getElementById('overlay').addEventListener('click', () => {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('open');
  });

  function timeAgo(iso) {
    const diff = Date.now() - new Date(iso).getTime();
    const h = Math.floor(diff / 3600000);
    const d = Math.floor(h / 24);
    if (d > 0) return d + 'd ago';
    if (h > 0) return h + 'h ago';
    return 'Just now';
  }

  function badgeClass(status) {
    const m = {pending:'badge-pending',in_progress:'badge-progress',completed:'badge-done',
                urgent:'badge-urgent',open:'badge-pending',resolved:'badge-done',
                active:'badge-done',on_leave:'badge-pending',info:'badge-progress'};
    return 'badge ' + (m[status] || 'badge-pending');
  }

  function badgeLabel(status) {
    const m = {in_progress:'In Progress', on_leave:'On Leave'};
    return m[status] || status;
  }

  function priorityColor(p) {
    return {low:'#0c6f57',medium:'#f59e0b',high:'#f97316',urgent:'#b8232f'}[p] || '#64748b';
  }

  function activityColor(s) {
    return {pending:'#f59e0b',completed:'#0c6f57',urgent:'#b8232f',info:'#0f4d85'}[s] || '#64748b';
  }

  function esc(str) {
    if (str == null) return '';
    return String(str)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
      .replace(/"/g,'&quot;');
  }
</script>
@yield('scripts')
</body>
</html>
