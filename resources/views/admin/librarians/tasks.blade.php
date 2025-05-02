@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Assign Tasks to Librarians</h3>
    <ul>
        @foreach($librarians as $librarian)
            <li>{{ $librarian->name }} ({{ $librarian->email }}) - [Task Form here]</li>
        @endforeach
    </ul>
</div>
@endsection
