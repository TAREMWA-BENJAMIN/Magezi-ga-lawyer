@extends('layouts.admin')
@section('title', 'Overview')

@section('styles')
<style>
  /* ── DASHBOARD SPECIFIC STYLES ── */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
  }
  
  .stat-card {
    background: var(--bg-card);
    border-radius: var(--radius);
    padding: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    border: 1px solid var(--border);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    position: relative;
    overflow: hidden;
  }
  
  .stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow);
    border-color: color-mix(in srgb, var(--c) 40%, var(--border));
  }
  
  .stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--c);
    border-radius: 4px 0 0 4px;
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: grid;
    place-items: center;
    font-size: 1.5rem;
    color: var(--c);
    background: color-mix(in srgb, var(--c) 15%, transparent);
    flex-shrink: 0;
  }

  .stat-icon svg {
    width: 24px;
    height: 24px;
  }

  .stat-body {
    flex: 1;
  }

  .stat-label {
    font-size: 0.8rem;
    color: var(--text-soft);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
  }

  .stat-value {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 0.25rem;
    line-height: 1;
  }

  .stat-sub {
    font-size: 0.8rem;
    color: var(--text-muted);
  }

  .stat-trend {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--c);
    background: color-mix(in srgb, var(--c) 15%, transparent);
    padding: 3px 8px;
    border-radius: 20px;
    display: inline-block;
    margin-top: 0.5rem;
  }

  .charts-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
  }

  .chart-card, .section-card {
    background: var(--bg-card);
    border-radius: var(--radius);
    padding: 1.5rem;
    border: 1px solid var(--border);
  }

  .chart-card h3, .section-card h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 2rem;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  /* Bar Chart styling */
  .bar-chart {
    display: flex;
    align-items: flex-end;
    gap: 1rem;
    height: 280px;
    padding-bottom: 2rem;
    position: relative;
    border-bottom: 1px solid var(--border);
  }

  .bar-group {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    height: 100%;
    position: relative;
  }

  .bar-pair {
    display: flex;
    gap: 6px;
    width: 100%;
    justify-content: center;
    height: 100%;
    align-items: flex-end;
  }

  .bar {
    width: clamp(8px, 30%, 30px);
    border-radius: 4px 4px 0 0;
    transition: height 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
  }
  
  .bar:hover {
    filter: brightness(1.2);
  }

  .bar-cases {
    background: linear-gradient(to top, var(--primary), var(--primary-lt));
  }

  .bar-resolved {
    background: linear-gradient(to top, var(--accent), #34d399);
  }

  .bar-label {
    position: absolute;
    bottom: -25px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-soft);
  }

  .bar-legend {
    position: absolute;
    bottom: -35px;
    right: 0;
    display: flex;
    gap: 1.5rem;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--text-soft);
  }

  .legend-dot {
    display: inline-block;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    margin-right: 6px;
  }

  /* Donut Chart styling */
  .donut-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
  }

  .donut-legend {
    list-style: none;
    padding: 0;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .donut-legend li {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--text-soft);
    padding: 0.5rem;
    border-radius: 8px;
    background: rgba(255,255,255,0.02);
    transition: background 0.2s ease;
  }
  
  .donut-legend li:hover {
    background: rgba(255,255,255,0.05);
  }

  .donut-legend li span {
    width: 12px;
    height: 12px;
    border-radius: 4px;
    margin-right: 12px;
  }

  .donut-legend li strong {
    margin-left: auto;
    color: var(--text);
    font-weight: 700;
  }

  /* Activity List styling */
  .activity-list {
    list-style: none;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .activity-item {
    display: flex;
    align-items: flex-start;
    gap: 1.25rem;
    padding: 1rem;
    border-radius: 8px;
    background: rgba(255,255,255,0.02);
    border: 1px solid transparent;
    transition: all 0.2s ease;
  }
  
  .activity-item:hover {
    background: rgba(255,255,255,0.04);
    border-color: var(--border);
  }

  .activity-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin-top: 5px;
    box-shadow: 0 0 0 4px rgba(255,255,255,0.05);
  }

  .activity-body {
    flex: 1;
  }

  .activity-body strong {
    display: block;
    font-size: 1rem;
    color: var(--text);
    margin-bottom: 0.35rem;
  }

  .activity-body p {
    font-size: 0.85rem;
    color: var(--text-muted);
    line-height: 1.5;
  }

  .activity-time {
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--text-soft);
    white-space: nowrap;
    background: rgba(255,255,255,0.05);
    padding: 4px 8px;
    border-radius: 4px;
  }

  @media (max-width: 1024px) {
    .charts-row {
      grid-template-columns: 1fr;
    }
  }
</style>
@endsection

@section('content')
<!-- Stat cards -->
<div class="stats-grid" id="stats-grid">
  <!-- populated by JS -->
</div>

<!-- Charts -->
<div class="charts-row">
  <div class="chart-card">
    <h3>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18.7 8l-5.1 5.2-2.8-2.7L7 14.3"/></svg>
      Monthly Case Trends
    </h3>
    <div class="bar-chart" id="bar-chart"><!-- JS --></div>
  </div>
  <div class="chart-card">
    <h3>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
      Cases by Category
    </h3>
    <div class="donut-wrapper" id="donut-wrapper"><!-- JS --></div>
  </div>
</div>

<!-- Activities -->
<div class="section-card">
  <h3>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
    Recent Activity
  </h3>
  <ul class="activity-list" id="activity-list"><!-- JS --></ul>
</div>
@endsection

@section('scripts')
<script>
  function iconBriefcase(){ return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>`; }
  function iconUsers()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>`; }
  function iconCheck()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>`; }
  function iconTicket()   { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/></svg>`; }
  function iconDocs()     { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>`; }
  function iconPhone()    { return `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 13a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2.17h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9.91a16 16 0 0 0 6.18 6.18l1.8-1.8a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>`; }

  async function loadData() {
    const s = {!! json_encode($stats) !!};
    const activities = {!! json_encode($activities) !!};
    
    // Stats cards
    const cards = [
      {label:'Legal Documents',  value:s.documentsInLibrary,                    icon:iconDocs(),      color:'#06b6d4', sub:'In library'},
      {label:'Emergency Calls',  value:s.emergencyCalls,                        icon:iconPhone(),     color:'#ef4444', sub:'This month'},
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

    // Bar chart
    const growth = s.monthlyGrowth;
    const max = Math.max(...growth.map(d => Math.max(d.cases, d.resolved)));
    
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
         <span><span class="legend-dot" style="background:var(--primary)"></span>Cases</span>
         <span><span class="legend-dot" style="background:var(--accent)"></span>Resolved</span>
       </div>`;

    // Donut chart
    const cats  = s.casesByCategory;
    const total = cats.reduce((s,d) => s+d.value, 0);
    const r=60, cx=70, cy=70, circ=2*Math.PI*r;
    let offset = 0;
    
    // Better colors for dark theme
    const darkColors = ['#3b82f6', '#10b981', '#ef4444', '#8b5cf6', '#f59e0b'];
    
    const segments = cats.map((d, i) => {
      const color = darkColors[i % darkColors.length];
      const frac = d.value/total;
      const dash = frac*circ, gap = circ-dash;
      const rot  = (offset/total)*360 - 90;
      offset += d.value;
      
      // Update object color for legend
      d.displayColor = color;
      
      return `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none"
        stroke="${color}" stroke-width="20"
        stroke-dasharray="${dash.toFixed(2)} ${gap.toFixed(2)}"
        stroke-dashoffset="0"
        transform="rotate(${rot.toFixed(2)} ${cx} ${cy})"
        style="transition:stroke-dasharray 1s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer;"
        stroke-linecap="round" />`;
    }).join('');
    
    const legend = cats.map(d =>
      `<li><span style="background:${d.displayColor}"></span>${esc(d.label)}<strong>${d.value}%</strong></li>`
    ).join('');
    
    document.getElementById('donut-wrapper').innerHTML = `
      <svg width="180" height="180" viewBox="0 0 140 140" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));">
        <!-- background track -->
        <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="20" />
        ${segments}
        <text x="${cx}" y="${cy-5}" text-anchor="middle" dominant-baseline="middle" fill="#e6edf3" font-size="22" font-weight="800">${total}%</text>
        <text x="${cx}" y="${cy+15}" text-anchor="middle" dominant-baseline="middle" fill="#8b949e" font-size="10" font-weight="600" text-transform="uppercase" letter-spacing="1">Total</text>
      </svg>
      <ul class="donut-legend">${legend}</ul>
    `;

    // Activity list
    document.getElementById('activity-list').innerHTML = activities.map(a => `
      <li class="activity-item">
        <span class="activity-dot" style="background:${activityColor(a.status)}; box-shadow: 0 0 0 4px color-mix(in srgb, ${activityColor(a.status)} 20%, transparent);"></span>
        <div class="activity-body">
          <strong>${esc(a.title)}</strong>
          <p>${esc(a.description)}</p>
        </div>
        <span class="activity-time">${timeAgo(a.timestamp)}</span>
      </li>
    `).join('');
  }

  document.addEventListener('DOMContentLoaded', loadData);
</script>
@endsection
