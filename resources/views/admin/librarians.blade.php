@extends('layouts.app')

@section('content')
<style>
    .neumorphic-container {
        background: #e0e0e0;
        border-radius: 20px;
        box-shadow: 8px 8px 20px #bebebe, -8px -8px 20px #ffffff;
        width: 75%;
        margin: 2rem auto;
        padding: 1.5rem;
        transition: all 0.3s ease-in-out;
    }
    .page-title {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #007bff;
        margin-top: 1rem;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
        text-shadow: 1px 1px 3px #bebebe;
    }
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .custom-table thead {
        background: #007bff;
        color: #fff;
    }
    .custom-table th,
    .custom-table td {
        padding: 0.6rem;
        text-align: center;
        border: 1px solid #d0d0d0;
    }
    .custom-table tbody tr {
        background: #f5f5f5;
        transition: background 0.3s;
    }
    .custom-table tbody tr:hover {
        background: #e0e0e0;
    }
    .no-data {
        text-align: center;
        font-size: 0.9rem;
        color: #555;
    }
</style>

<h2 class="page-title">All Librarians</h2>

<div class="neumorphic-container">
    @if($librarians->isEmpty())
        <p class="no-data">No librarians found.</p>
    @else
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($librarians as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
