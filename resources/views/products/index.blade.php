@extends('layout')

@section('content')
<div class="container">
    <h2>Product List</h2>
    <table id="productsTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Images</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
</div>


@endsection