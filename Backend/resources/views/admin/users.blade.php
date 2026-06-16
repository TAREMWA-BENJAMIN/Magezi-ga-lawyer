@extends('layouts.admin')
@section('title', 'Registered Users')

@section('content')
<div class="view-header">
  <h2 style="font-size:1.1rem; font-weight:700; margin:0;">Registered Users</h2>
  <p style="font-size:0.85rem; color:var(--text-soft); margin-top:4px;">List of all users who have registered on the platform.</p>
</div>
<div class="table-wrap">
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Registered At</th>
      </tr>
    </thead>
    <tbody id="users-tbody">
      @forelse($users as $user)
      <tr>
        <td><span class="case-id">{{ $user->id }}</span></td>
        <td><strong>{{ $user->name }}</strong></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : 'N/A' }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="4" style="text-align: center; padding: 20px; color: var(--text-soft);">No users registered yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
