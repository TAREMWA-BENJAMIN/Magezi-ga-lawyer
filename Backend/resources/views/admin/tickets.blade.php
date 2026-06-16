@extends('layouts.admin')
@section('title', 'Tickets')

@section('content')
<div class="tickets-list" id="tickets-list"><!-- JS --></div>
@endsection

@section('scripts')
<style>
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
</style>
<script>
  let ticketsData = {!! json_encode($tickets) !!};

  function renderTickets() {
    document.getElementById('tickets-list').innerHTML = ticketsData.map(t => `
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

  document.addEventListener('DOMContentLoaded', renderTickets);
</script>
@endsection
