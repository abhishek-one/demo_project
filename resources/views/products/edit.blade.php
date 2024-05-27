@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Product</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
        </div>
        <div class="form-group">
            <label for="product_price">Product Price:</label>
            <input type="text" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price }}" required>
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <textarea class="form-control" id="product_description" name="product_description" required>{{ $product->product_description }}</textarea>
        </div>
        <div class="form-group">
            <label for="product_images">Product Images:</label>
            <input type="file" class="form-control" id="product_images" name="product_images[]" multiple>
            <div class="mt-2">
                @if(is_array($product->product_images))
                @foreach($product->product_images as $image)
                <img src="{{ asset('storage/' . $image) }}" width="100" class="mr-2">
                @endforeach
                @elseif(is_string($product->product_images))
                @php
                $images = json_decode($product->product_images, true);
                @endphp
                @if(is_array($images))
                @foreach($images as $image)
                <img src="{{ asset('storage/' . $image) }}" width="100" class="mr-2">
                @endforeach
                @else
                <p>No images found</p>
                @endif
                @else
                <p>No images found</p>
                @endif
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection