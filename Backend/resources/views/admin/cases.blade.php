@extends('layouts.admin')
@section('title', 'Cases')

@section('content')
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
@endsection

@section('scripts')
<script>
  let casesData = {!! json_encode($cases) !!};
  let caseFilter = 'all';

  function renderCases() {
    const filtered = caseFilter === 'all'
      ? casesData
      : casesData.filter(c => c.status === caseFilter);

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

  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.filter-tab').forEach(tab => {
      tab.addEventListener('click', () => {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
        caseFilter = tab.dataset.filter;
        renderCases();
      });
    });
    renderCases();
  });
</script>
@endsection
