<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Poducts list page
    public function index()
    {
        // sections list（category列を使う前提）
        $sections = Section::all();

        // products list（pagenation）
        $products = Product::paginate(15);

        // Pass to Blade
        return view('products.index', compact('products', 'sections'));
    }



    public function category($category)
    {
        // category = “lifestyle” or “furniture” will be included

        // ① Retrieve all sections for the relevant category
        $sections = Section::where('category', $category)->get();

        // ② Convert section IDs into an array
        $sectionIds = $sections->pluck('id')->toArray();

        // ③ Retrieve all products belonging to the section ID (セクションIDに属する商品を全取得)
        $products = Product::whereIn('section_id', $sectionIds)->get();

        return view('products.category', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where('name', 'like', "%{$keyword}%")
            ->orWhere('description', 'like', "%{$keyword}%")
            ->get();

        return view('products.search', compact('products', 'keyword'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    
    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }

}
