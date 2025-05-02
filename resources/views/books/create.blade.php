@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add a New Book</h1>

    <form method="POST" action="{{ url('/librarian/books') }}" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="author">Author</label>
            <input type="text" id="author" name="author" class="form-control" value="{{ old('author') }}" required>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-control" value="{{ old('isbn') }}" required>
        </div>

        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" id="publisher" name="publisher" class="form-control" value="{{ old('publisher') }}">
        </div>

        <div class="form-group">
            <label for="edition">Edition</label>
            <input type="text" id="edition" name="edition" class="form-control" value="{{ old('edition') }}">
        </div>

        <div class="form-group">
            <label for="publication_year">Publication Year</label>
            <input type="number" id="publication_year" name="publication_year" class="form-control" value="{{ old('publication_year') }}">
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" id="genre" name="genre" class="form-control" value="{{ old('genre') }}">
        </div>

        <div class="form-group">
            <label for="language">Language</label>
            <input type="text" id="language" name="language" class="form-control" value="{{ old('language') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="total_copies">Total Copies</label>
            <input type="number" id="total_copies" name="total_copies" class="form-control" value="{{ old('total_copies') }}" required>
        </div>

        <div class="form-group">
            <label for="available_copies">Available Copies</label>
            <input type="number" id="available_copies" name="available_copies" class="form-control" value="{{ old('available_copies') }}" required>
        </div>

        <div class="form-group">
            <label for="shelf_location">Shelf Location</label>
            <input type="text" id="shelf_location" name="shelf_location" class="form-control" value="{{ old('shelf_location') }}">
        </div>

        <div class="form-group">
            <label for="cover_image">Cover Image</label>
            <input type="file" id="cover_image" name="cover_image" class="form-control">
        </div>

        <div class="form-group">
            <label for="book_type">Book Type</label>
            <select id="book_type" name="book_type" class="form-control">
                <option value="Printed" {{ old('book_type') == 'Printed' ? 'selected' : '' }}>Printed</option>
                <option value="Digital" {{ old('book_type') == 'Digital' ? 'selected' : '' }}>Digital</option>
                <option value="Audio" {{ old('book_type') == 'Audio' ? 'selected' : '' }}>Audio</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file_url">File URL (if Digital)</label>
            <input type="url" id="file_url" name="file_url" class="form-control" value="{{ old('file_url') }}">
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" step="0.01">
        </div>

        <div class="form-group">
            <label for="penalty">Penalty</label>
            <input type="number" id="penalty" name="penalty" class="form-control" value="{{ old('penalty') }}" step="0.01">
        </div>

        <button type="submit" class="btn btn-primary">Add Book</button>
    </form>
</div>
@endsection
