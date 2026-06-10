<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard — Magezi ga Lawyer</title>
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

    /* ── VIEWS ─────────────────────────────────────────────────────────────── */
    .view { display: none; }
    .view.active { display: block; }

    /* ── STAT CARDS ────────────────────────────────────────────────────────── */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
      gap: 16px; margin-bottom: 24px;
    }
    .stat-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 20px;
      display: flex; gap: 16px; align-items: flex-start;
      transition: transform var(--transition), border-color var(--transition);
      position: relative; overflow: hidden;
    }
    .stat-card::before {
      content: ''; position: absolute; top: 0; left: 0; right: 0;
      height: 3px; background: var(--c, var(--primary));
      border-radius: var(--radius) var(--radius) 0 0;
    }
    .stat-card:hover { transform: translateY(-2px); border-color: rgba(255,255,255,.12); }
    .stat-icon {
      width: 42px; height: 42px; border-radius: 10px;
      display: grid; place-items: center; flex-shrink: 0;
      background: color-mix(in srgb, var(--c, var(--primary)) 15%, transparent);
      color: var(--c, var(--primary));
    }
    .stat-icon svg { width: 20px; height: 20px; }
    .stat-label { margin: 0; font-size: .78rem; color: var(--text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: .05em; }
    .stat-value { margin: 4px 0 0; font-size: 1.8rem; font-weight: 800; line-height: 1; }
    .stat-sub   { margin: 4px 0 0; font-size: .78rem; color: var(--text-soft); }
    .stat-trend { margin: 6px 0 0; font-size: .75rem; color: #34d399; font-weight: 600; }

    /* ── CHARTS ROW ────────────────────────────────────────────────────────── */
    .charts-row { display: grid; grid-template-columns: 1.4fr 1fr; gap: 16px; margin-bottom: 24px; }
    .chart-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 24px;
    }
    .chart-card h3 { margin: 0 0 20px; font-size: .95rem; font-weight: 700; }

    /* ── BAR CHART ─────────────────────────────────────────────────────────── */
    .bar-chart {
      display: flex; align-items: flex-end; gap: 10px;
      height: 160px; position: relative; padding-bottom: 30px;
    }
    .bar-group {
      flex: 1; display: flex; flex-direction: column;
      align-items: center; height: 100%; justify-content: flex-end; gap: 4px;
    }
    .bar-pair {
      display: flex; gap: 3px; align-items: flex-end;
      height: calc(100% - 20px); width: 100%; justify-content: center;
    }
    .bar {
      flex: 1; border-radius: 4px 4px 0 0;
      transition: height .6s cubic-bezier(.34,1.56,.64,1);
      min-height: 4px; cursor: pointer; max-width: 18px;
    }
    .bar-cases    { background: var(--primary); }
    .bar-resolved { background: var(--accent); opacity: .8; }
    .bar:hover    { opacity: .7; }
    .bar-label    { font-size: .72rem; color: var(--text-muted); text-align: center; position: absolute; bottom: 8px; }
    .bar-legend   { position: absolute; bottom: -4px; right: 0; display: flex; gap: 12px; font-size: .75rem; color: var(--text-soft); }
    .legend-dot   { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 4px; vertical-align: middle; }

    /* ── DONUT CHART ───────────────────────────────────────────────────────── */
    .donut-wrapper  { display: flex; align-items: center; gap: 20px; flex-wrap: wrap; }
    .donut-legend   { list-style: none; display: flex; flex-direction: column; gap: 8px; }
    .donut-legend li{ display: flex; align-items: center; gap: 8px; font-size: .8rem; color: var(--text-soft); }
    .donut-legend li span   { width: 10px; height: 10px; border-radius: 2px; flex-shrink: 0; display: inline-block; }
    .donut-legend li strong { margin-left: auto; color: var(--text); padding-left: 8px; }

    /* ── SECTION CARD ──────────────────────────────────────────────────────── */
    .section-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 24px;
    }
    .section-card h3 { margin: 0 0 20px; font-size: .95rem; font-weight: 700; }

    /* ── ACTIVITY LIST ─────────────────────────────────────────────────────── */
    .activity-list { list-style: none; display: flex; flex-direction: column; }
    .activity-item { display: flex; align-items: flex-start; gap: 14px; padding: 14px 0; border-bottom: 1px solid var(--border); }
    .activity-item:last-child { border-bottom: none; }
    .activity-dot  { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; margin-top: 5px; }
    .activity-body { flex: 1; }
    .activity-body strong { font-size: .88rem; }
    .activity-body p      { margin: 2px 0 0; font-size: .8rem; color: var(--text-soft); }
    .activity-time { font-size: .75rem; color: var(--text-muted); white-space: nowrap; flex-shrink: 0; }

    /* ── PROGRESS ──────────────────────────────────────────────────────────── */
    .progress-track { flex: 1; height: 6px; background: rgba(255,255,255,.08); border-radius: 999px; overflow: hidden; }
    .progress-fill  { height: 100%; border-radius: 999px; background: var(--primary); transition: width .6s cubic-bezier(.34,1.56,.64,1); }

    /* ── BADGES ────────────────────────────────────────────────────────────── */
    .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: .72rem; font-weight: 600; text-transform: capitalize; white-space: nowrap; }
    .badge-pending  { background: rgba(245,158,11,.15); color: #fbbf24; border: 1px solid rgba(245,158,11,.25); }
    .badge-progress { background: rgba(15,77,133,.2);   color: #60a5fa; border: 1px solid rgba(15,77,133,.3); }
    .badge-done     { background: rgba(12,111,87,.15);  color: #34d399; border: 1px solid rgba(12,111,87,.25); }
    .badge-urgent   { background: rgba(184,35,47,.15);  color: #f87171; border: 1px solid rgba(184,35,47,.25); }

    /* ── PRIORITY DOT ──────────────────────────────────────────────────────── */
    .pdot { display: inline-block; width: 7px; height: 7px; border-radius: 50%; margin-right: 6px; vertical-align: middle; }

    /* ── FILTER TABS ───────────────────────────────────────────────────────── */
    .view-header  { margin-bottom: 20px; }
    .filter-tabs  { display: flex; gap: 6px; flex-wrap: wrap; }
    .filter-tab {
      padding: 7px 16px; border-radius: 999px;
      border: 1px solid var(--border); background: var(--bg-card);
      color: var(--text-soft); font: 500 .85rem var(--font); cursor: pointer;
      transition: all var(--transition);
    }
    .filter-tab:hover  { border-color: rgba(255,255,255,.15); color: var(--text); }
    .filter-tab.active { background: var(--primary); border-color: var(--primary); color: white; }

    /* ── CASES TABLE ───────────────────────────────────────────────────────── */
    .table-wrap { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; font-size: .85rem; }
    thead th {
      text-align: left; padding: 14px 16px; font-weight: 600;
      font-size: .75rem; text-transform: uppercase; letter-spacing: .06em;
      color: var(--text-muted); border-bottom: 1px solid var(--border); white-space: nowrap;
    }
    tbody td { padding: 14px 16px; border-bottom: 1px solid var(--border); color: var(--text); vertical-align: middle; }
    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: var(--bg-hover); }
    .case-id { font-family: monospace; font-size: .8rem; color: var(--text-muted); background: rgba(255,255,255,.05); padding: 2px 7px; border-radius: 5px; }
    .cat-tag { font-size: .75rem; padding: 3px 9px; border-radius: 5px; background: rgba(255,255,255,.05); color: var(--text-soft); white-space: nowrap; }
    td .prog-row { display: flex; align-items: center; gap: 8px; }
    td .prog-num { font-size: .8rem; color: var(--text-muted); min-width: 30px; }

    /* ── USERS GRID ────────────────────────────────────────────────────────── */
    .users-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
    .user-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 20px;
      display: flex; gap: 14px; align-items: flex-start;
      transition: transform var(--transition), border-color var(--transition);
    }
    .user-card:hover { transform: translateY(-2px); border-color: rgba(255,255,255,.12); }
    .user-avatar {
      width: 44px; height: 44px; border-radius: 12px;
      background: linear-gradient(135deg, var(--primary), var(--primary-lt));
      display: grid; place-items: center;
      font-weight: 700; font-size: .82rem; color: white; flex-shrink: 0;
    }
    .user-info { flex: 1; min-width: 0; }
    .user-info strong { font-size: .9rem; display: block; }
    .user-info p { margin: 3px 0 0; font-size: .8rem; color: var(--text-soft); }
    .user-email { font-size: .75rem !important; color: var(--text-muted) !important; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .user-meta  { display: flex; flex-direction: column; align-items: flex-end; gap: 6px; }
    .user-stat  { text-align: center; }
    .user-stat span { font-size: 1.2rem; font-weight: 800; display: block; }
    .user-stat small{ font-size: .72rem; color: var(--text-muted); }
    .user-join  { margin: 0; font-size: .72rem; color: var(--text-muted); }

    /* ── TICKETS ───────────────────────────────────────────────────────────── */
    .tickets-list { display: flex; flex-direction: column; gap: 12px; }
    .ticket-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: var(--radius); padding: 18px 20px;
      display: flex; flex-direction: column; gap: 8px;
      transition: transform var(--transition);
    }
    .ticket-card:hover { transform: translateY(-1px); }
    .ticket-card.p-urgent { border-left: 3px solid var(--danger); }
    .ticket-card.p-high   { border-left: 3px solid var(--amber); }
    .ticket-card.p-medium { border-left: 3px solid var(--primary); }
    .ticket-card.p-low    { border-left: 3px solid var(--accent); }
    .ticket-head    { display: flex; align-items: center; justify-content: space-between; }
    .ticket-subject { font-size: .9rem; }
    .ticket-meta    { display: flex; gap: 20px; font-size: .78rem; color: var(--text-muted); flex-wrap: wrap; }
    .ticket-meta em { color: var(--text-soft); font-style: normal; }

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
      <button class="nav-btn active" data-view="overview" id="nav-overview">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
          </svg>
        </span>
        Overview
      </button>
      <button class="nav-btn" data-view="cases" id="nav-cases">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
          </svg>
        </span>
        Cases
      </button>
      <button class="nav-btn" data-view="team" id="nav-team">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </span>
        Team
      </button>
      <button class="nav-btn" data-view="tickets" id="nav-tickets">
        <span class="nav-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
          </svg>
        </span>
        Tickets
      </button>
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
        <h1 class="topbar-title" id="page-title">Overview</h1>
        <span class="api-badge offline" id="api-badge">● Demo Mode</span>
      </div>
      <div class="topbar-right">
        <button class="icon-btn" id="refresh-btn" title="Refresh data" aria-label="Refresh">
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

      <!-- ── OVERVIEW VIEW ──────────────────────────────────────────────── -->
      <section class="view active" id="view-overview">
        <!-- Stat cards -->
        <div class="stats-grid" id="stats-grid">
          <!-- populated by JS -->
        </div>

        <!-- Charts -->
        <div class="charts-row">
          <div class="chart-card">
            <h3>Monthly Case Trends</h3>
            <div class="bar-chart" id="bar-chart"><!-- JS --></div>
          </div>
          <div class="chart-card">
            <h3>Cases by Category</h3>
            <div class="donut-wrapper" id="donut-wrapper"><!-- JS --></div>
          </div>
        </div>

        <!-- Activities -->
        <div class="section-card">
          <h3>Recent Activity</h3>
          <ul class="activity-list" id="activity-list"><!-- JS --></ul>
        </div>
      </section>

      <!-- ── CASES VIEW ─────────────────────────────────────────────────── -->
      <section class="view" id="view-cases">
        <div class="view-header">
          <div class="filter-tabs" id="case-filters">
            <button class="filter-tab active" data-filter="all">All</button>
            <button class="filter-tab" data-filter="pending">Pending</button>
            <button class="filter-tab" data-filter="in_progress">In Progress</button>
            <button class="filter-tab" data-filter="completed">Completed</button>
          </div>
        </div>
        <div class="table-wrap">
          <table>
            <thead>
              <tr>
                <th>Case ID</th><th>Title</th><th>Category</th><th>Client</th>
                <th>Assigned To</th><th>Priority</th><th>Status</th><th>Progress</th>
              </tr>
            </thead>
            <tbody id="cases-tbody"><!-- JS --></tbody>
          </table>
        </div>
      </section>

      <!-- ── TEAM VIEW ──────────────────────────────────────────────────── -->
      <section class="view" id="view-team">
        <div class="users-grid" id="users-grid"><!-- JS --></div>
      </section>

      <!-- ── TICKETS VIEW ───────────────────────────────────────────────── -->
      <section class="view" id="view-tickets">
        <div class="tickets-list" id="tickets-list"><!-- JS --></div>
      </section>

    </main>
  </div><!-- /.main -->
</div><!-- /#app -->

<script>
/* ═══════════════════════════════════════════════════════════════════════════
   MOCK DATA  (used when API is unreachable)
═══════════════════════════════════════════════════════════════════════════ */
const MOCK = {
  stats: {
    totalCases: 1250, activeUsers: 842, completedCases: 756, pendingCases: 318,
    successRate: 92.5, averageResolutionDays: 45, totalSupportTickets: 1543,
    newUsersThisWeek: 125, documentsInLibrary: 340, emergencyCalls: 28,
    monthlyGrowth: [
      {month:'Jan',cases:85, resolved:72},
      {month:'Feb',cases:92, resolved:80},
      {month:'Mar',cases:110,resolved:95},
      {month:'Apr',cases:98, resolved:88},
      {month:'May',cases:130,resolved:115},
      {month:'Jun',cases:145,resolved:128},
    ],
    casesByCategory: [
      {label:'Property Law',  value:32,color:'#0f4d85'},
      {label:'Family Law',    value:24,color:'#0c6f57'},
      {label:'Criminal Law',  value:18,color:'#b8232f'},
      {label:'Employment Law',value:14,color:'#8b5cf6'},
      {label:'Commercial Law',value:12,color:'#f59e0b'},
    ],
  },
  cases: [
    {id:'CASE-001',title:'Land Dispute - Central Region',          category:'Property Law',   status:'pending',     priority:'high',   createdDate:'2026-06-07',assignedTo:'John Mukasa',   progress:45,  client:'Alice Nambi'},
    {id:'CASE-002',title:'Contract Breach - Commercial Deal',      category:'Commercial Law', status:'in_progress', priority:'medium', createdDate:'2026-06-05',assignedTo:'Sarah Nakambi', progress:75,  client:'Robert Ssemakula'},
    {id:'CASE-003',title:'Family Law - Inheritance Dispute',       category:'Family Law',     status:'completed',   priority:'low',    createdDate:'2026-05-31',assignedTo:'Grace Okonkwo', progress:100, client:'Mary Tendo'},
    {id:'CASE-004',title:'Employment Dispute - Unfair Dismissal',  category:'Employment Law', status:'in_progress', priority:'high',   createdDate:'2026-06-03',assignedTo:'David Osei',    progress:60,  client:'Peter Wamala'},
    {id:'CASE-005',title:'Criminal Defense - Theft Charges',       category:'Criminal Law',   status:'pending',     priority:'urgent', createdDate:'2026-06-09',assignedTo:'Peter Banda',   progress:20,  client:'James Kiiza'},
    {id:'CASE-006',title:'Property Lease Agreement Review',        category:'Property Law',   status:'completed',   priority:'low',    createdDate:'2026-05-27',assignedTo:'John Mukasa',   progress:100, client:'Susan Byamugisha'},
    {id:'CASE-007',title:'Domestic Violence - Protection Order',   category:'Family Law',     status:'in_progress', priority:'urgent', createdDate:'2026-06-08',assignedTo:'Grace Okonkwo', progress:55,  client:'Anonymous'},
    {id:'CASE-008',title:'Business Partnership Dissolution',       category:'Commercial Law', status:'pending',     priority:'medium', createdDate:'2026-06-06',assignedTo:'Sarah Nakambi', progress:15,  client:'Kato Enterprises Ltd'},
  ],
  users: [
    {id:1,name:'John Mukasa',   role:'Senior Lawyer',     email:'john@magezi.ug',   cases:32,status:'active',  joinDate:'2023-02-15',avatar:'JM'},
    {id:2,name:'Sarah Nakambi', role:'Advocate',           email:'sarah@magezi.ug',  cases:28,status:'active',  joinDate:'2023-05-20',avatar:'SN'},
    {id:3,name:'Grace Okonkwo', role:'Legal Aid Officer',  email:'grace@magezi.ug',  cases:21,status:'active',  joinDate:'2023-08-10',avatar:'GO'},
    {id:4,name:'David Osei',    role:'Paralegal',          email:'david@magezi.ug',  cases:15,status:'active',  joinDate:'2024-01-05',avatar:'DO'},
    {id:5,name:'Peter Banda',   role:'Advocate',           email:'peter@magezi.ug',  cases:19,status:'on_leave',joinDate:'2023-11-12',avatar:'PB'},
    {id:6,name:'Amina Otieno',  role:'Legal Aid Officer',  email:'amina@magezi.ug',  cases:12,status:'active',  joinDate:'2024-03-22',avatar:'AO'},
  ],
  activities: [
    {id:1,type:'case_created',    title:'New case filed',        description:'Land dispute case filed in Central Region',           timestamp:new Date(Date.now()-7200000).toISOString(),   status:'pending'},
    {id:2,type:'case_resolved',   title:'Case resolved',         description:'Property inheritance case successfully resolved',      timestamp:new Date(Date.now()-18000000).toISOString(),  status:'completed'},
    {id:3,type:'user_registered', title:'New users joined',      description:'125 new users registered this week',                  timestamp:new Date(Date.now()-86400000).toISOString(),  status:'info'},
    {id:4,type:'support_ticket',  title:'Emergency support',     description:'Emergency legal support request received from Kampala',timestamp:new Date(Date.now()-86400000).toISOString(),  status:'urgent'},
    {id:5,type:'document_updated',title:'Library updated',       description:'Legal library updated with 15 new documents',         timestamp:new Date(Date.now()-172800000).toISOString(), status:'info'},
    {id:6,type:'case_created',    title:'Family Law case filed',  description:'Domestic violence protection order requested',         timestamp:new Date(Date.now()-172800000).toISOString(), status:'urgent'},
  ],
  tickets: [
    {id:'TKT-001',subject:'Need help filing land case',    from:'Alice Nambi',  status:'open',     priority:'high',   created:new Date(Date.now()-10800000).toISOString()},
    {id:'TKT-002',subject:'Emergency - domestic violence', from:'Anonymous',    status:'urgent',   priority:'urgent', created:new Date(Date.now()-3600000).toISOString()},
    {id:'TKT-003',subject:'Document translation needed',   from:'Ssemakula R.', status:'pending',  priority:'low',    created:new Date(Date.now()-86400000).toISOString()},
    {id:'TKT-004',subject:'Case status inquiry',           from:'Mary Tendo',   status:'resolved', priority:'medium', created:new Date(Date.now()-172800000).toISOString()},
  ],
};

/* ═══════════════════════════════════════════════════════════════════════════
   STATE
═══════════════════════════════════════════════════════════════════════════ */
let data        = { ...MOCK };
let activeView  = 'overview';
let caseFilter  = 'all';
let apiOnline   = false;

/* ═══════════════════════════════════════════════════════════════════════════
   HELPERS
═══════════════════════════════════════════════════════════════════════════ */
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
  return String(str)
    .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
    .replace(/"/g,'&quot;');
}

/* ═══════════════════════════════════════════════════════════════════════════
   RENDER OVERVIEW
═══════════════════════════════════════════════════════════════════════════ */
function renderOverview() {
  const s = data.stats;

  /* ── Stat cards ── */
  const cards = [
    {label:'Total Cases',      value:s.totalCases.toLocaleString(),           icon:iconBriefcase(), color:'#0f4d85', trend:'↑ 12% this month'},
    {label:'Active Users',     value:s.activeUsers.toLocaleString(),           icon:iconUsers(),     color:'#0c6f57', trend:'+'+s.newUsersThisWeek+' this week'},
    {label:'Resolved Cases',   value:s.completedCases.toLocaleString(),        icon:iconCheck(),     color:'#8b5cf6', trend:s.successRate+'% success rate'},
    {label:'Support Tickets',  value:s.totalSupportTickets.toLocaleString(),   icon:iconTicket(),    color:'#f59e0b', sub:s.pendingCases+' pending'},
    {label:'Legal Documents',  value:s.documentsInLibrary,                     icon:iconDocs(),      color:'#06b6d4', sub:'In library'},
    {label:'Emergency Calls',  value:s.emergencyCalls,                         icon:iconPhone(),     color:'#b8232f', sub:'This month'},
  ];
  document.getElementById('stats-grid').innerHTML = cards.map(c => `
    <div class="stat-card" style="--c:${c.color}">
      <div class="stat-icon">${c.icon}</div>
      <div class="stat-body">
        <p class="stat-label">${esc(c.label)}</p>
        <p class="stat-value">${esc(c.value)}</p>
        ${c.sub   ? `<p class="stat-sub">${esc(c.sub)}</p>`   : ''}
        ${c.trend ? `<p class="stat-trend">${esc(c.trend)}</p>` : ''}
      </div>
    </div>
  `).join('');

  /* ── Bar chart ── */
  const growth = s.monthlyGrowth;
  const max = Math.max(...growth.map(d => d.cases));
  document.getElementById('bar-chart').innerHTML =
    growth.map(d => `
      <div class="bar-group">
        <div class="bar-pair">
          <div class="bar bar-cases"    style="height:${(d.cases/max*100).toFixed(1)}%" title="Cases: ${d.cases}"></div>
          <div class="bar bar-resolved" style="height:${(d.resolved/max*100).toFixed(1)}%" title="Resolved: ${d.resolved}"></div>
        </div>
        <span class="bar-label">${esc(d.month)}</span>
      </div>
    `).join('') +
    `<div class="bar-legend">
       <span><span class="legend-dot" style="background:#0f4d85"></span>Cases</span>
       <span><span class="legend-dot" style="background:#0c6f57"></span>Resolved</span>
     </div>`;

  /* ── Donut chart ── */
  const cats  = s.casesByCategory;
  const total = cats.reduce((s,d) => s+d.value, 0);
  const r=60, cx=70, cy=70, circ=2*Math.PI*r;
  let offset = 0;
  const segments = cats.map(d => {
    const frac = d.value/total;
    const dash = frac*circ, gap = circ-dash;
    const rot  = (offset/total)*360 - 90;
    offset += d.value;
    return `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none"
      stroke="${d.color}" stroke-width="20"
      stroke-dasharray="${dash.toFixed(2)} ${gap.toFixed(2)}"
      stroke-dashoffset="0"
      transform="rotate(${rot.toFixed(2)} ${cx} ${cy})"
      style="transition:stroke-dasharray .5s ease"/>`;
  }).join('');
  const legend = cats.map(d =>
    `<li><span style="background:${d.color}"></span>${esc(d.label)}<strong>${d.value}%</strong></li>`
  ).join('');
  document.getElementById('donut-wrapper').innerHTML = `
    <svg width="140" height="140" viewBox="0 0 140 140">
      ${segments}
      <text x="${cx}" y="${cy}"    text-anchor="middle" dominant-baseline="middle" fill="#e6edf3" font-size="18" font-weight="700">${total}%</text>
      <text x="${cx}" y="${cy+16}" text-anchor="middle" dominant-baseline="middle" fill="#6e7681" font-size="10">total</text>
    </svg>
    <ul class="donut-legend">${legend}</ul>
  `;

  /* ── Activity list ── */
  document.getElementById('activity-list').innerHTML = data.activities.map(a => `
    <li class="activity-item">
      <span class="activity-dot" style="background:${activityColor(a.status)}"></span>
      <div class="activity-body">
        <strong>${esc(a.title)}</strong>
        <p>${esc(a.description)}</p>
      </div>
      <span class="activity-time">${timeAgo(a.timestamp)}</span>
    </li>
  `).join('');
}

/* ═══════════════════════════════════════════════════════════════════════════
   RENDER CASES
═══════════════════════════════════════════════════════════════════════════ */
function renderCases() {
  const filtered = caseFilter === 'all'
    ? data.cases
    : data.cases.filter(c => c.status === caseFilter);

  document.getElementById('cases-tbody').innerHTML = filtered.map(c => `
    <tr>
      <td><span class="case-id">${esc(c.id)}</span></td>
      <td><strong>${esc(c.title)}</strong></td>
      <td><span class="cat-tag">${esc(c.category)}</span></td>
      <td>${esc(c.client)}</td>
      <td>${esc(c.assignedTo)}</td>
      <td><span class="pdot" style="background:${priorityColor(c.priority)}"></span>${esc(c.priority)}</td>
      <td><span class="${badgeClass(c.status)}">${badgeLabel(c.status)}</span></td>
      <td>
        <div class="prog-row">
          <div class="progress-track"><div class="progress-fill" style="width:${c.progress}%"></div></div>
          <span class="prog-num">${c.progress}%</span>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ═══════════════════════════════════════════════════════════════════════════
   RENDER TEAM
═══════════════════════════════════════════════════════════════════════════ */
function renderTeam() {
  document.getElementById('users-grid').innerHTML = data.users.map(u => `
    <div class="user-card">
      <div class="user-avatar">${esc(u.avatar)}</div>
      <div class="user-info">
        <strong>${esc(u.name)}</strong>
        <p>${esc(u.role)}</p>
        <p class="user-email">${esc(u.email)}</p>
      </div>
      <div class="user-meta">
        <span class="${badgeClass(u.status)}">${badgeLabel(u.status)}</span>
        <div class="user-stat"><span>${u.cases}</span><small>Cases</small></div>
        <p class="user-join">Since ${esc(u.joinDate)}</p>
      </div>
    </div>
  `).join('');
}

/* ═══════════════════════════════════════════════════════════════════════════
   RENDER TICKETS
═══════════════════════════════════════════════════════════════════════════ */
function renderTickets() {
  document.getElementById('tickets-list').innerHTML = data.tickets.map(t => `
    <div class="ticket-card p-${t.priority}">
      <div class="ticket-head">
        <span class="case-id">${esc(t.id)}</span>
        <span class="${badgeClass(t.status)}">${badgeLabel(t.status)}</span>
      </div>
      <strong class="ticket-subject">${esc(t.subject)}</strong>
      <div class="ticket-meta">
        <span>From: <em>${esc(t.from)}</em></span>
        <span><span class="pdot" style="background:${priorityColor(t.priority)}"></span>${esc(t.priority)}</span>
        <span>${timeAgo(t.created)}</span>
      </div>
    </div>
  `).join('');
}

/* ═══════════════════════════════════════════════════════════════════════════
   RENDER ACTIVE VIEW
═══════════════════════════════════════════════════════════════════════════ */
function renderCurrentView() {
  if (activeView === 'overview') renderOverview();
  if (activeView === 'cases')    renderCases();
  if (activeView === 'team')     renderTeam();
  if (activeView === 'tickets')  renderTickets();
}

/* ═══════════════════════════════════════════════════════════════════════════
   API FETCH
═══════════════════════════════════════════════════════════════════════════ */
async function fetchAll() {
  const bar    = document.getElementById('loading-bar');
  const refBtn = document.getElementById('refresh-btn');
  bar.style.display = 'block';
  refBtn.querySelector('svg').classList.add('spinning');

  try {
    const [s, c, u, a, t] = await Promise.all([
      fetch('/api/admin/stats').then(r => { if(!r.ok) throw new Error(); return r.json(); }),
      fetch('/api/admin/cases').then(r => { if(!r.ok) throw new Error(); return r.json(); }),
      fetch('/api/admin/users').then(r => { if(!r.ok) throw new Error(); return r.json(); }),
      fetch('/api/admin/activities').then(r => { if(!r.ok) throw new Error(); return r.json(); }),
      fetch('/api/admin/tickets').then(r => { if(!r.ok) throw new Error(); return r.json(); }),
    ]);
    data.stats      = s;
    data.cases      = c.data ?? c;
    data.users      = u;
    data.activities = a;
    data.tickets    = t;
    apiOnline = true;
  } catch {
    apiOnline = false;
    // keep mock data
  }

  const badge = document.getElementById('api-badge');
  if (apiOnline) {
    badge.textContent = '● API Live';
    badge.className   = 'api-badge online';
  } else {
    badge.textContent = '● Demo Mode';
    badge.className   = 'api-badge offline';
  }

  bar.style.display = 'none';
  refBtn.querySelector('svg').classList.remove('spinning');
  renderCurrentView();
}

/* ═══════════════════════════════════════════════════════════════════════════
   NAVIGATION
═══════════════════════════════════════════════════════════════════════════ */
const VIEW_TITLES = {overview:'Overview', cases:'Cases', team:'Team', tickets:'Tickets'};

function switchView(viewId) {
  // hide all views
  document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
  // deactivate all nav buttons
  document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));

  activeView = viewId;
  document.getElementById('view-' + viewId).classList.add('active');
  document.getElementById('nav-'  + viewId).classList.add('active');
  document.getElementById('page-title').textContent = VIEW_TITLES[viewId] || 'Dashboard';

  // close sidebar on mobile
  document.getElementById('sidebar').classList.remove('open');
  document.getElementById('overlay').classList.remove('open');

  renderCurrentView();
}

/* ═══════════════════════════════════════════════════════════════════════════
   INLINE SVG ICONS
═══════════════════════════════════════════════════════════════════════════ */
function iconBriefcase(){ return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>`; }
function iconUsers()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>`; }
function iconCheck()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`; }
function iconTicket()   { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/></svg>`; }
function iconDocs()     { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`; }
function iconPhone()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.17h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.8-1.8a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>`; }

/* ═══════════════════════════════════════════════════════════════════════════
   BOOT
═══════════════════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {

  /* Nav buttons */
  document.querySelectorAll('.nav-btn[data-view]').forEach(btn => {
    btn.addEventListener('click', () => switchView(btn.dataset.view));
  });

  /* Case filter tabs */
  document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', () => {
      document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      caseFilter = tab.dataset.filter;
      renderCases();
    });
  });

  /* Mobile sidebar toggle */
  document.getElementById('menu-toggle').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('open');
    document.getElementById('overlay').classList.toggle('open');
  });
  document.getElementById('overlay').addEventListener('click', () => {
    document.getElementById('sidebar').classList.remove('open');
    document.getElementById('overlay').classList.remove('open');
  });

  /* Refresh button */
  document.getElementById('refresh-btn').addEventListener('click', fetchAll);

  /* Initial render with mock data, then try live API */
  renderCurrentView();
  fetchAll();
});
</script>
</body>
</html>
