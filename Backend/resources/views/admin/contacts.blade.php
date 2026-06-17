@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
<div class="view-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 1.5rem;">
  <div>
    <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Contact Messages</h2>
    <p style="font-size:0.85rem; color:var(--text-soft); margin-top:4px;">View and manage inquiries sent through the public contact form.</p>
  </div>
  <div style="position:relative; width: 300px;">
    <input type="text" id="search-input" placeholder="Search by name, email, or subject..." style="width:100%; padding:8px 16px; background:var(--bg-surface); border:1px solid var(--border); border-radius:var(--radius-sm); color:white; font-size:0.85rem;" oninput="filterMessages()" />
  </div>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Subject</th>
        <th>Message Preview</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody id="messages-tbody">
      @forelse($submissions as $sub)
      <tr class="message-row" data-name="{{ strtolower($sub->name) }}" data-email="{{ strtolower($sub->email) }}" data-subject="{{ strtolower($sub->subject) }}">
        <td>{{ $sub->created_at ? $sub->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
        <td><strong>{{ $sub->name }}</strong></td>
        <td><a href="mailto:{{ $sub->email }}" style="color: #60a5fa; text-decoration: none;">{{ $sub->email }}</a></td>
        <td>{{ $sub->phone ?? 'N/A' }}</td>
        <td><span style="font-weight: 500;">{{ $sub->subject }}</span></td>
        <td><div class="msg-preview">{{ $sub->message }}</div></td>
        <td>
          <button class="view-btn" onclick='showMessage({!! json_encode($sub) !!})'>Read Message</button>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-soft);">No contact messages received yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>

<!-- Message Detail Modal -->
<div id="message-modal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:999; align-items:center; justify-content:center;">
  <div style="background:var(--bg-card); width:600px; max-width:95%; border-radius:var(--radius); padding:28px; border:1px solid var(--border); position:relative; box-shadow: var(--shadow);">
    <h3 style="margin-bottom:20px; font-size:1.2rem; font-weight:700; border-bottom:1px solid var(--border); padding-bottom:12px;" id="modal-subject">Subject</h3>
    
    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:20px; font-size:0.85rem;">
      <div>
        <span style="color:var(--text-soft); display:block; margin-bottom: 2px;">From</span>
        <strong id="modal-name" style="color:var(--text);">Name</strong>
      </div>
      <div>
        <span style="color:var(--text-soft); display:block; margin-bottom: 2px;">Email</span>
        <strong id="modal-email" style="color:var(--text);">Email</strong>
      </div>
      <div>
        <span style="color:var(--text-soft); display:block; margin-bottom: 2px;">Phone</span>
        <strong id="modal-phone" style="color:var(--text);">Phone</strong>
      </div>
      <div>
        <span style="color:var(--text-soft); display:block; margin-bottom: 2px;">Submitted At</span>
        <strong id="modal-date" style="color:var(--text);">Date</strong>
      </div>
    </div>
    
    <div style="background:var(--bg-surface); padding:16px; border-radius:var(--radius-sm); border:1px solid var(--border); margin-bottom:24px; min-height:120px; max-height:300px; overflow-y:auto;">
      <span style="color:var(--text-soft); display:block; font-size:0.75rem; margin-bottom:8px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Message Details</span>
      <p id="modal-message" style="white-space:pre-wrap; font-size:0.9rem; line-height:1.6; color:var(--text);"></p>
    </div>
    
    <div style="display:flex; justify-content:flex-end;">
      <button type="button" onclick="closeMessageModal()" style="padding:8px 20px; border-radius:999px; border:1px solid var(--border); background:transparent; color:var(--text); cursor:pointer; font-weight:600; transition:all var(--transition);">Close</button>
    </div>
  </div>
</div>
@endsection

@section('styles')
<style>
    .table-wrap {
      background: var(--bg-card);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      overflow-x: auto;
      margin-top: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 0.88rem;
    }
    th, td {
      padding: 14px 20px;
      border-bottom: 1px solid var(--border);
    }
    th {
      background: rgba(255, 255, 255, 0.02);
      font-weight: 600;
      color: var(--text-soft);
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    tr:last-child td {
      border-bottom: none;
    }
    tr:hover td {
      background: rgba(255, 255, 255, 0.015);
    }
    .msg-preview {
      max-width: 200px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      color: var(--text-soft);
    }
    .view-btn {
      background: none;
      border: none;
      color: #60a5fa;
      cursor: pointer;
      text-decoration: underline;
      font-weight: 500;
      padding: 0;
      font-family: inherit;
    }
    .view-btn:hover {
      color: #93c5fd;
    }
</style>
@endsection

@section('scripts')
<script>
  function showMessage(submission) {
    document.getElementById('modal-subject').innerText = submission.subject;
    document.getElementById('modal-name').innerText = submission.name;
    document.getElementById('modal-email').innerText = submission.email;
    document.getElementById('modal-phone').innerText = submission.phone || 'N/A';
    
    // Formatting the date nicely
    let dateStr = 'N/A';
    if (submission.created_at) {
      const d = new Date(submission.created_at);
      if (!isNaN(d.getTime())) {
        dateStr = d.getFullYear() + '-' + 
                  String(d.getMonth() + 1).padStart(2, '0') + '-' + 
                  String(d.getDate()).padStart(2, '0') + ' ' + 
                  String(d.getHours()).padStart(2, '0') + ':' + 
                  String(d.getMinutes()).padStart(2, '0');
      }
    }
    document.getElementById('modal-date').innerText = dateStr;
    document.getElementById('modal-message').innerText = submission.message;
    document.getElementById('message-modal').style.display = 'flex';
  }

  function closeMessageModal() {
    document.getElementById('message-modal').style.display = 'none';
  }

  // Close modal when clicking outside of the modal card
  window.addEventListener('click', function(event) {
    const modal = document.getElementById('message-modal');
    if (event.target === modal) {
      closeMessageModal();
    }
  });

  // Client-side search filtering
  function filterMessages() {
    const query = document.getElementById('search-input').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.message-row');
    
    rows.forEach(row => {
      const name = row.getAttribute('data-name');
      const email = row.getAttribute('data-email');
      const subject = row.getAttribute('data-subject');
      
      if (name.includes(query) || email.includes(query) || subject.includes(query)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  }
</script>
@endsection
