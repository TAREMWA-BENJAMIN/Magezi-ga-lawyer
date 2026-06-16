@extends('layouts.admin')
@section('title', 'Legal Acts Management')

@section('content')
<div class="view-header">
  <h2>Upload Legal Act</h2>
</div>

@if(session('success'))
<div style="background: rgba(76, 175, 80, 0.1); color: #2e7d32; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; border: 1px solid #4caf50;">
  {{ session('success') }}
</div>
@endif

@if($errors->any())
<div style="background: rgba(244, 67, 54, 0.1); color: #c62828; padding: 1rem; border-radius: 4px; margin-bottom: 1rem; border: 1px solid #f44336;">
  <ul style="margin:0; padding-left:20px;">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="card" style="background: var(--surface); padding: 1.5rem; border-radius: 8px; border: 1px solid var(--border); margin-bottom: 2rem;">
  <form action="{{ route('admin.acts.store') }}" method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 1rem;">
    @csrf
    <div>
      <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Title *</label>
      <input type="text" name="title" required value="{{ old('title') }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 4px; background: var(--background); color: var(--text);" placeholder="The Land Act, 1998">
    </div>
    
    <div>
      <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Description</label>
      <textarea name="description" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 4px; background: var(--background); color: var(--text);" placeholder="Brief description of the act...">{{ old('description') }}</textarea>
    </div>
    
    <div>
      <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Year</label>
      <input type="text" name="year" value="{{ old('year') }}" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border); border-radius: 4px; background: var(--background); color: var(--text);" placeholder="e.g. 1998">
    </div>
    
    <div>
      <label style="display:block; margin-bottom:0.5rem; font-weight:500;">PDF Document * (Max 20MB)</label>
      <input type="file" name="pdf_document" accept="application/pdf" required style="width: 100%; padding: 0.75rem; background: var(--background); border-radius: 4px; color: var(--text); border: 1px solid var(--border);">
    </div>
    
    <div style="margin-top: 1rem;">
      <button type="submit" class="btn" style="background: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 4px; cursor: pointer; font-weight: bold; transition: background-color 0.2s;">
        Upload Act
      </button>
    </div>
  </form>
</div>

<div class="view-header" style="margin-top: 2rem;">
  <h2>Uploaded Legal Acts</h2>
</div>

<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>Title</th>
        <th>Year</th>
        <th>File Size</th>
        <th>Uploaded</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($acts as $act)
      <tr>
        <td><strong>{{ $act->title }}</strong></td>
        <td>{{ $act->year }}</td>
        <td>{{ $act->file_size }}</td>
        <td>{{ $act->created_at->format('M d, Y') }}</td>
        <td>
          <a href="{{ asset('storage/' . $act->file_path) }}" target="_blank" style="color: var(--primary); text-decoration: none; margin-right: 1rem; font-weight: 500;">View</a>
          <form action="{{ route('admin.acts.destroy', $act->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this act?');">
            @csrf
            @method('DELETE')
            <button type="submit" style="background: none; border: none; color: #f44336; cursor: pointer; padding: 0; text-decoration: underline; font-weight: 500;">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="5" style="text-align: center; padding: 2rem; color: var(--text-muted);">No acts uploaded yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
