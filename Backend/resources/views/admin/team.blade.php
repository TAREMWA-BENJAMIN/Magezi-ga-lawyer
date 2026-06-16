@extends('layouts.admin')
@section('title', 'Team')

@section('content')
<div class="users-grid" id="users-grid"><!-- JS --></div>
@endsection

@section('scripts')
<script>
  let teamData = {!! json_encode($users) !!};

  function renderTeam() {
    document.getElementById('users-grid').innerHTML = teamData.map(u => `
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

  document.addEventListener('DOMContentLoaded', renderTeam);
</script>
@endsection
