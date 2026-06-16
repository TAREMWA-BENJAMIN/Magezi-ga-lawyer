@extends('layouts.admin')
@section('title', 'Home Photos (Hero Slides)')

@section('content')
<div class="view-header" style="display:flex; justify-content:space-between; align-items:center;">
  <div>
    <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Manage Home Page Photos</h2>
    <p style="font-size:0.85rem; color:var(--text-soft); margin-top:4px;">Add, edit, or remove photos shown on the home page slider.</p>
  </div>
  <button class="filter-tab active" onclick="editSlide()" style="background:var(--primary);color:#fff;border:none;">+ Add Photo</button>
</div>
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>Preview</th><th>Title</th><th>Alt Text</th><th>Sort Order</th><th>Active</th><th>Actions</th>
      </tr>
    </thead>
    <tbody id="slides-tbody"><!-- JS --></tbody>
  </table>
</div>

<!-- Slide Edit Modal -->
<div id="slide-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:999; align-items:center; justify-content:center;">
  <div style="background:var(--bg-card); width:500px; max-width:90%; border-radius:var(--radius); padding:24px; border:1px solid var(--border);">
    <h3 style="margin-bottom:16px;" id="sm-title">Edit Photo</h3>
    <form id="slide-form" enctype="multipart/form-data">
      <input type="hidden" id="sm-id" />
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Photo File <span id="sm-file-req" style="color:var(--danger)">*</span></label>
        <input type="file" id="sm-image" accept="image/*" style="width:100%; color:white;" />
      </div>
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Title (Optional)</label>
        <input type="text" id="sm-title-input" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
      </div>
      <div style="margin-bottom:12px;">
        <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Alt Text (Required for accessibility)</label>
        <input type="text" id="sm-alt-input" required style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
      </div>
      <div style="display:flex; gap:12px; margin-bottom:16px;">
        <div style="flex:1;">
          <label style="display:block; font-size:0.8rem; color:var(--text-soft); margin-bottom:4px;">Sort Order</label>
          <input type="number" id="sm-order" style="width:100%; padding:8px 12px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white;" />
        </div>
        <div style="flex:1; display:flex; align-items:center; margin-top:16px;">
          <label style="display:flex; align-items:center; gap:8px; font-size:0.8rem; color:white; cursor:pointer;">
            <input type="checkbox" id="sm-active" checked /> Is Active
          </label>
        </div>
      </div>
      <div style="display:flex; justify-content:flex-end; gap:8px;">
        <button type="button" onclick="closeSlideModal()" style="padding:8px 16px; border-radius:999px; border:1px solid var(--border); background:transparent; color:var(--text); cursor:pointer;">Cancel</button>
        <button type="submit" style="padding:8px 16px; border-radius:999px; border:none; background:var(--primary); color:white; font-weight:600; cursor:pointer;">Save Photo</button>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  let slidesData = {!! json_encode($heroSlides) !!};

  function renderSlides() {
    document.getElementById('slides-tbody').innerHTML = (slidesData || []).map(s => `
      <tr>
        <td>
          <div style="width:80px; height:50px; background:#0d1117; border-radius:4px; overflow:hidden;">
            ${s.image_url ? `<img src="${s.image_url}" style="width:100%; height:100%; object-fit:cover;" />` : ''}
          </div>
        </td>
        <td><strong>${esc(s.title || '')}</strong></td>
        <td>${esc(s.alt_text || '')}</td>
        <td>${s.sort_order}</td>
        <td><span class="${s.is_active ? 'badge-done' : 'badge-pending'} badge">${s.is_active ? 'Yes' : 'No'}</span></td>
        <td>
          <button onclick="editSlide(${s.id})" style="background:transparent;border:none;color:#60a5fa;cursor:pointer;margin-right:8px;">Edit</button>
          <button onclick="deleteSlide(${s.id})" style="background:transparent;border:none;color:#f87171;cursor:pointer;">Delete</button>
        </td>
      </tr>
    `).join('');
  }

  function editSlide(id) {
    const form = document.getElementById('slide-form');
    form.reset();
    document.getElementById('sm-id').value = '';
    document.getElementById('sm-title').textContent = 'Add Home Photo';
    document.getElementById('sm-file-req').style.display = 'inline';

    if (id) {
      const s = slidesData.find(x => x.id === id);
      if (s) {
        document.getElementById('sm-title').textContent = 'Edit Home Photo';
        document.getElementById('sm-id').value = s.id;
        document.getElementById('sm-title-input').value = s.title || '';
        document.getElementById('sm-alt-input').value = s.alt_text || '';
        document.getElementById('sm-order').value = s.sort_order || '';
        document.getElementById('sm-active').checked = s.is_active;
        document.getElementById('sm-file-req').style.display = 'none'; // not required on edit
      }
    }
    document.getElementById('slide-modal').style.display = 'flex';
  }

  function closeSlideModal() {
    document.getElementById('slide-modal').style.display = 'none';
  }

  document.getElementById('slide-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const id = document.getElementById('sm-id').value;
    
    const formData = new FormData();
    const fileField = document.getElementById('sm-image').files[0];
    if (fileField) {
      formData.append('image', fileField);
    } else if (!id) {
      alert("Please select an image file.");
      return;
    }

    formData.append('title', document.getElementById('sm-title-input').value);
    formData.append('alt_text', document.getElementById('sm-alt-input').value);
    
    if (document.getElementById('sm-order').value) {
      formData.append('sort_order', document.getElementById('sm-order').value);
    }
    
    formData.append('is_active', document.getElementById('sm-active').checked ? '1' : '0');

    try {
      const url = id ? '/api/admin/hero-slides/' + id : '/api/admin/hero-slides';

      const res = await fetch(url, {
        method: 'POST', 
        headers: {
          'Accept': 'application/json'
        },
        body: formData
      });
      if (!res.ok) {
         const data = await res.json();
         throw new Error(data.message || 'Failed to save');
      }
      closeSlideModal();
      window.location.reload();
    } catch (err) {
      alert(err.message);
    }
  });

  async function deleteSlide(id) {
    if (!confirm('Are you sure you want to delete this photo?')) return;
    try {
      const res = await fetch('/api/admin/hero-slides/' + id, { method: 'DELETE' });
      if (!res.ok) throw new Error('Failed to delete');
      window.location.reload();
    } catch (err) {
      alert(err.message);
    }
  }

  document.addEventListener('DOMContentLoaded', renderSlides);
</script>
@endsection
