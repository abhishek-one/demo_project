<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::all();
            return datatables()->of($products)
                ->addColumn('product_images', function ($product) {
                    $images = $product->product_images;
                    $imageTags = '';
                    if ($images) {
                        if (!is_array($images)) {
                            $images = json_decode($images, true);
                        }
                        if (is_array($images)) {
                            $imageTags = '<img src="/storage/' . implode('" width="50" /><img src="/storage/', $images) . '" width="50" />';
                        } else {
                            $imageTags = 'No images';
                        }
                    }
                    return $imageTags;
                })
                ->addColumn('actions', function ($product) {
                    $editUrl = route('products.edit', $product->id);
                    $deleteUrl = route('products.destroy', $product->id);
                    return '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
                            <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>';
                })
                ->rawColumns(['product_images', 'actions'])
                ->make(true);
        }

        return view('products.index');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required|numeric',
            'product_description' => 'required|string',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator->errors())
                ->withInput();
        }

        $imagePaths = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $path = Storage::disk('public')->put('productimg', $image);
                $imagePaths[] = $path;
            }
        }

        Product::create([
            'product_name' => $request['product_name'],
            'product_price' => $request['product_price'],
            'product_description' => $request['product_description'],
            'product_images' => $imagePaths
        ]);


        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePaths = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $path = Storage::disk('public')->put('productimg', $image);
                $imagePaths[] = $path;
            }
        }

        $product->update([
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_description' => $request->product_description,
            'product_images' => json_encode($imagePaths),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
