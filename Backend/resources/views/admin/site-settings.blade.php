@extends('layouts.admin')
@section('title', 'Site Settings')

@section('styles')
<style>
  .settings-tabs {
    display: flex; gap: 6px; margin-bottom: 24px; padding: 6px; background: rgba(255, 255, 255, 0.03); border: 1px solid var(--border); border-radius: var(--radius-sm); overflow-x: auto;
  }
  .tab-btn {
    flex: 1; text-align: center; padding: 10px 16px; border: none; background: transparent; color: var(--text-soft); font-size: 0.95rem; font-weight: 600; cursor: pointer; border-radius: 8px; transition: all 0.2s; white-space: nowrap;
  }
  .tab-btn:hover { color: var(--text); background: rgba(255, 255, 255, 0.08); }
  .tab-btn.active { color: #fff; background: var(--primary-lt); box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); }
  .tab-pane { display: none; }
  .tab-pane.active { display: block; animation: fadeIn 0.3s ease; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection

@section('content')
<div class="view-header">
  <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Site Settings</h2>
  <p style="font-size:0.85rem; color:var(--text-soft); margin-top:4px;">Update the text displayed on the main landing pages.</p>
</div>
<div class="section-card" style="max-width: 600px;">
  <div class="settings-tabs" id="settings-tabs">
    <button type="button" class="tab-btn active" data-target="tab-home">Home Page</button>
    <button type="button" class="tab-btn" data-target="tab-about">About Page</button>
    <button type="button" class="tab-btn" data-target="tab-footer">Footer</button>
  </div>

  <form id="site-settings-form">
    <!-- Home Tab -->
    <div class="tab-pane active" id="tab-home">
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
    </div> <!-- End Home Tab -->

    <!-- About Tab -->
    <div class="tab-pane" id="tab-about">
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
    </div> <!-- End About Tab -->

    <!-- Footer Tab -->
    <div class="tab-pane" id="tab-footer">
      <h3 style="margin-bottom:16px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">Footer</h3>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Footer Tagline</label>
      <textarea id="ss-footer-tagline" required rows="3" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.9rem;"></textarea>
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Footer Phone</label>
      <input type="text" id="ss-footer-phone" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Footer Email</label>
      <input type="text" id="ss-footer-email" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Footer Address</label>
      <input type="text" id="ss-footer-address" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Facebook URL</label>
      <input type="text" id="ss-footer-facebook" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Twitter URL</label>
      <input type="text" id="ss-footer-twitter" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:16px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">LinkedIn URL</label>
      <input type="text" id="ss-footer-linkedin" style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>
    <div style="margin-bottom:24px;">
      <label style="display:block; font-size:0.85rem; color:var(--text-soft); margin-bottom:6px;">Footer Bottom Text</label>
      <input type="text" id="ss-footer-bottom" required style="width:100%; padding:10px 14px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.95rem;" />
    </div>

    </div> <!-- End Footer Tab -->

    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border);">
      <button type="submit" id="ss-submit-btn" style="padding:10px 24px; border-radius:999px; border:none; background:var(--primary); color:white; font-weight:600; cursor:pointer; width:100%;">Save All Changes</button>
    </div>
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

    document.getElementById('ss-footer-tagline').value = ss.footer_tagline || '';
    document.getElementById('ss-footer-phone').value = ss.footer_phone || '';
    document.getElementById('ss-footer-email').value = ss.footer_email || '';
    document.getElementById('ss-footer-address').value = ss.footer_address || '';
    document.getElementById('ss-footer-facebook').value = ss.footer_facebook || '';
    document.getElementById('ss-footer-twitter').value = ss.footer_twitter || '';
    document.getElementById('ss-footer-linkedin').value = ss.footer_linkedin || '';
    document.getElementById('ss-footer-bottom').value = ss.footer_bottom_text || '';
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
      footer_tagline: document.getElementById('ss-footer-tagline').value,
      footer_phone: document.getElementById('ss-footer-phone').value,
      footer_email: document.getElementById('ss-footer-email').value,
      footer_address: document.getElementById('ss-footer-address').value,
      footer_facebook: document.getElementById('ss-footer-facebook').value,
      footer_twitter: document.getElementById('ss-footer-twitter').value,
      footer_linkedin: document.getElementById('ss-footer-linkedin').value,
      footer_bottom_text: document.getElementById('ss-footer-bottom').value,
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

  document.addEventListener('DOMContentLoaded', () => {
    renderSiteSettings();

    // Tab switching logic
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        // Remove active class from all
        tabBtns.forEach(b => b.classList.remove('active'));
        tabPanes.forEach(p => p.classList.remove('active'));

        // Add active class to clicked button and target pane
        btn.classList.add('active');
        const targetId = btn.getAttribute('data-target');
        document.getElementById(targetId).classList.add('active');
      });
    });
  });
</script>
@endsection
