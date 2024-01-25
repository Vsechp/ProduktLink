@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Category</h2>
        <a href="{{ route('categories.index') }}" class="btn btn-outline-dark">Categories</a>
        <form action="{{ route('categories.store') }}" method="post">

            @csrf
            <div class="form-group col-md-4">
                <label for="name">Category Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" style="margin-top: 10px;" class="btn btn-outline-dark">Add Category</button>
        </form>
    </div>
@endsection
