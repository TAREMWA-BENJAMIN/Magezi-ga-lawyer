@extends('layouts.admin')
@section('title', 'Site Settings')

@section('content')
<div class="view-header">
  <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Site Settings</h2>
  <p style="font-size:0.85rem; color:var(--text-soft); margin-top:4px;">Update the text displayed on the main landing pages.</p>
</div>
<div class="section-card" style="max-width: 600px;">
  <form id="site-settings-form">
    <h3 style="margin-bottom:16px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">Home Page - Hero Section</h3>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Hero Eyebrow</label>
      <input type="text" id="ss-home-hero-eyebrow" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Hero Title</label>
      <input type="text" id="ss-home-title" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:24px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Hero Subtitle</label>
      <textarea id="ss-home-subtitle" required rows="4" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>

    <h3 style="margin-bottom:16px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">Home Page - Practice Areas Section</h3>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Section Eyebrow</label>
      <input type="text" id="ss-home-practice-eyebrow" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Section Title</label>
      <input type="text" id="ss-home-practice-title" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:24px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Section Description</label>
      <textarea id="ss-home-practice-text" required rows="3" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>

    <h3 style="margin-bottom:16px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">About Page</h3>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">About Header Title</label>
      <input type="text" id="ss-about-title" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">About Header Text</label>
      <textarea id="ss-about-text" required rows="3" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Mission Text</label>
      <textarea id="ss-mission-text" required rows="3" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>
    <div style="margin-bottom:24px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Vision Text</label>
      <textarea id="ss-vision-text" required rows="3" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>

    <button type="submit" id="ss-submit-btn" style="padding:10px 24px; border-radius:999px; border:none; background:var(--primary); color:white; font-weight:600; cursor:pointer; width:100%;">Save Changes</button>
  </form>
</div>
@endsection

@section('scripts')
<script>
  let siteSettings = {!! json_encode($siteSettings) !!};

  function renderSiteSettings() {
    const ss = siteSettings || {};
    document.getElementById('ss-home-hero-eyebrow').value = ss.home_hero_eyebrow || '';
    document.getElementById('ss-home-title').value = ss.home_hero_title || '';
    document.getElementById('ss-home-subtitle').value = ss.home_hero_subtitle || '';
    document.getElementById('ss-home-practice-eyebrow').value = ss.home_practice_eyebrow || '';
    document.getElementById('ss-home-practice-title').value = ss.home_practice_title || '';
    document.getElementById('ss-home-practice-text').value = ss.home_practice_text || '';
    
    document.getElementById('ss-about-title').value = ss.about_header_title || '';
    document.getElementById('ss-about-text').value = ss.about_header_text || '';
    document.getElementById('ss-mission-text').value = ss.about_mission_text || '';
    document.getElementById('ss-vision-text').value = ss.about_vision_text || '';
  }

  document.getElementById('site-settings-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = document.getElementById('ss-submit-btn');
    const originalText = btn.textContent;
    btn.textContent = 'Saving...';
    btn.disabled = true;

    const payload = {
      home_hero_eyebrow: document.getElementById('ss-home-hero-eyebrow').value,
      home_hero_title: document.getElementById('ss-home-title').value,
      home_hero_subtitle: document.getElementById('ss-home-subtitle').value,
      home_practice_eyebrow: document.getElementById('ss-home-practice-eyebrow').value,
      home_practice_title: document.getElementById('ss-home-practice-title').value,
      home_practice_text: document.getElementById('ss-home-practice-text').value,
      about_header_title: document.getElementById('ss-about-title').value,
      about_header_text: document.getElementById('ss-about-text').value,
      about_mission_text: document.getElementById('ss-mission-text').value,
      about_vision_text: document.getElementById('ss-vision-text').value,
    };

    try {
      const res = await fetch('/api/admin/site-settings', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      if (!res.ok) throw new Error('Failed to save settings');
      
      btn.textContent = 'Saved!';
      btn.style.background = 'var(--accent)';
      setTimeout(() => {
        btn.textContent = originalText;
        btn.style.background = 'var(--primary)';
        btn.disabled = false;
      }, 2000);
    } catch (err) {
      alert(err.message);
      btn.textContent = originalText;
      btn.disabled = false;
    }
  });

  document.addEventListener('DOMContentLoaded', renderSiteSettings);
</script>
@endsection
