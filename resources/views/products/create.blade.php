@extends('layout')
@section('content')

<div class="container">
    <h2>Add Product</h2>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{old('product_name')}}" required>
            @error('product_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="text" class="form-control" id="product_price" name="product_price" value="{{old('product_price')}}" required>
            @error('product_price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" id="product_description" name="product_description" required>{{old('product_description')}}</textarea>
            @error('product_description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="product_images">Product Images:</label>
            <input type="file" class="form-control" id="product_images" name="product_images[]" value="{{old('product_images[]')}}" multiple>
            @error('product_images')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection