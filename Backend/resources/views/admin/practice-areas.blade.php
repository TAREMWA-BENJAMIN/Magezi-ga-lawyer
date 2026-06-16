@extends('layouts.admin')
@section('title', 'Practice Areas')

@section('content')
<div class="view-header" style="display:flex; justify-content:space-between; align-items:center;">
  <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Manage Practice Areas</h2>
  <button class="filter-tab active" onclick="editPracticeArea()" style="background:var(--primary);color:#fff;border:none;">+ Add New</button>
</div>
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>ID</th><th>Emoji</th><th>Title</th><th>Slug</th><th>Actions</th>
      </tr>
    </thead>
    <tbody id="practice-areas-tbody"><!-- JS --></tbody>
  </table>
</div>

<!-- Practice Area Edit Modal -->
<div id="practice-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:999; align-items:center; justify-content:center;">
  <div style="background:var(--bg-card); width:500px; max-width:90%; border-radius:var(--radius); padding:24px; border:1px solid var(--border);">
    <h3 style="margin-bottom:16px;" id="pm-title">Edit Practice Area</h3>
    <form id="practice-form">
      <input type="hidden" id="pm-id" />
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Title</label>
        <input type="text" id="pm-title-input" required style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
      </div>
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Slug</label>
        <input type="text" id="pm-slug-input" required style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
      </div>
      <div style="display:flex; gap:12px; margin-bottom:12px;">
        <div style="flex:1;">
          <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Emoji Icon</label>
          <input type="text" id="pm-emoji-input" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
        </div>
        <div style="flex:1;">
          <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Lucide Icon</label>
          <input type="text" id="pm-icon-input" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
        </div>
      </div>
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Short Description</label>
        <textarea id="pm-short-desc" required rows="2" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;"></textarea>
      </div>
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Description</label>
        <textarea id="pm-desc" rows="4" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;"></textarea>
      </div>
      <div style="margin-bottom:16px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Features (comma separated)</label>
        <textarea id="pm-features" rows="2" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;"></textarea>
      </div>
      <div style="display:flex; justify-content:flex-end; gap:8px;">
        <button type="button" onclick="closePracticeModal()" style="padding:8px 16px; border-radius:999px; border:1px solid var(--border); background:transparent; color:var(--text); cursor:pointer;">Cancel</button>
        <button type="submit" style="padding:8px 16px; border-radius:999px; border:none; background:var(--primary); color:white; font-weight:600; cursor:pointer;">Save</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  let practiceAreas = {!! json_encode($practiceAreas) !!};

  function renderPracticeAreas() {
    document.getElementById('practice-areas-tbody').innerHTML = (practiceAreas || []).map(p => `
      <tr>
        <td><span class="case-id">${p.id}</span></td>
        <td style="font-size:1.2rem;">${esc(p.emoji_icon || '')}</td>
        <td><strong>${esc(p.title)}</strong></td>
        <td>${esc(p.slug)}</td>
        <td>
          <button onclick="editPracticeArea(${p.id})" style="background:transparent;border:none;color:#60a5fa;cursor:pointer;margin-right:8px;">Edit</button>
          <button onclick="deletePracticeArea(${p.id})" style="background:transparent;border:none;color:#f87171;cursor:pointer;">Delete</button>
        </td>
      </tr>
    `).join('');
  }

  function editPracticeArea(id) {
    const form = document.getElementById('practice-form');
    form.reset();
    document.getElementById('pm-id').value = '';
    document.getElementById('pm-title').textContent = 'Add Practice Area';

    if (id) {
      const p = practiceAreas.find(x => x.id === id);
      if (p) {
        document.getElementById('pm-title').textContent = 'Edit Practice Area';
        document.getElementById('pm-id').value = p.id;
        document.getElementById('pm-title-input').value = p.title || '';
        document.getElementById('pm-slug-input').value = p.slug || '';
        document.getElementById('pm-emoji-input').value = p.emoji_icon || '';
        document.getElementById('pm-icon-input').value = p.icon || '';
        document.getElementById('pm-short-desc').value = p.short_description || '';
        document.getElementById('pm-desc').value = p.description || '';
        document.getElementById('pm-features').value = (p.features || []).join(', ');
      }
    }
    document.getElementById('practice-modal').style.display = 'flex';
  }

  function closePracticeModal() {
    document.getElementById('practice-modal').style.display = 'none';
  }

  document.getElementById('practice-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('pm-id').value;
    const payload = {
      title: document.getElementById('pm-title-input').value,
      slug: document.getElementById('pm-slug-input').value,
      emoji_icon: document.getElementById('pm-emoji-input').value,
      icon: document.getElementById('pm-icon-input').value,
      short_description: document.getElementById('pm-short-desc').value,
      description: document.getElementById('pm-desc').value,
      features: document.getElementById('pm-features').value.split(',').map(s=>s.trim()).filter(Boolean)
    };

    try {
      const url = id ? '/api/admin/practice-areas/' + id : '/api/admin/practice-areas';
      const res = await fetch(url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      if (!res.ok) {
        const errData = await res.json().catch(() => ({ message: 'Failed to save' }));
        throw new Error(errData.message || 'Failed to save');
      }
      closePracticeModal();
      window.location.reload();
    } catch (err) {
      alert(err.message);
    }
  });

  async function deletePracticeArea(id) {
    if (!confirm('Are you sure you want to delete this practice area?')) return;
    try {
      const res = await fetch('/api/admin/practice-areas/' + id, { method: 'DELETE' });
      if (!res.ok) {
        const errData = await res.json().catch(() => ({ message: 'Failed to delete' }));
        throw new Error(errData.message || 'Failed to delete');
      }
      window.location.reload();
    } catch (err) {
      alert(err.message);
    }
  }

  document.addEventListener('DOMContentLoaded', renderPracticeAreas);
</script>
@endsection
