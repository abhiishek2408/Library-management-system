<!-- resources/views/librarian/manage-categories-genres.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Manage Categories and Genres</h4>

    <!-- Search and Filter Form -->
    <form method="GET" action="{{ route('librarian.manage.categories.genres') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search Categories or Genres" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Filter</button>
        </div>
    </form>

    <!-- Categories Section -->
    <div class="mb-5">
        <h5>Categories</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Genres Section -->
    <div>
        <h5>Genres</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Genre Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($genres as $index => $genre)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $genre->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No genres found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
