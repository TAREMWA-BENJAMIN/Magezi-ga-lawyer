@extends('layouts.admin')
@section('title', 'Overview')

@section('content')
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

    // Bar chart
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

    // Donut chart
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

    // Activity list
    document.getElementById('activity-list').innerHTML = activities.map(a => `
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

  document.addEventListener('DOMContentLoaded', loadData);
</script>
@endsection
