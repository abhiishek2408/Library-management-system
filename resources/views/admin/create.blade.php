@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add Librarian</h2>
    <form action="{{ route('admin.librarians.store') }}" method="POST">
        @csrf
        <input name="name" class="form-control mb-3" placeholder="Name" required>
        <input name="email" class="form-control mb-3" placeholder="Email" required>
        <input name="password" class="form-control mb-3" placeholder="Password" type="password" required>
        <button class="btn btn-primary">Add Librarian</button>
    </form>
</div>
@endsection
