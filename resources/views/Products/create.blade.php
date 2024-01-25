@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Product</h2>
        <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Products</a>
        <form action="{{ route('products.store') }}" method="post">

            @csrf
            <div class="form-group col-md-4">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group col-md-4">
                <label for="price">Product Price:</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group col-md-4">
                <label for="category">Select Category:</label>
                <select class="form-control" id="category" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" style="margin-top: 10px;"  class="btn btn-outline-dark">Create Product</button>
        </form>
    </div>
@endsection
