<?php

namespace App\Http\Controllers\Admin\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Category;
use Illuminate\Support\Str;
use App\Models\BackEnd\SubCategory;

class CategoryController extends Controller {
    public function index() {
        return view( 'admin.backend.category.index' );
    }

    public function api(Request $request){
        $query = $request->input('search');
        $categories = Category::when($query, function ($q) use ($query) {
            return $q->where('category_name', 'LIKE', "%$query%");
        })->latest()->paginate(7);
    
        return response()->json($categories);
    }

    public function create() {
        return view( 'admin.backend.category.create' );
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'category_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            $existingCategory = Category::where('category_name', $request->category_name)->first();
    
            if ($existingCategory) {
                return back()->withInput()->with('error', 'Category already exists.');
            }
    
            $imagePath = null;
    
            if ($request->hasFile('category_img')) {
                $imagePath = $request->file('category_img')->store('category', 'public');
            }
    
            Category::create([
                'category_name' => $request->category_name,
                'category_img' => $imagePath,
                'subcategory_count' => 0,
                'product_count' => 0,
                'slug' => Str::slug($request->category_name),
            ]);
    
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }    

    public function destroy( $id ) {
        $category = Category::find($id);
        SubCategory::where('category_id', $id)->delete();
        $category->delete();

        return redirect()->route( 'categories.index' )->with( 'success', 'Category deleted successfully.' );
    }

    public function show($id){
        $category = Category::findOrFail($id);
        return view('admin.backend.category.show' , compact('category'));
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.backend.category.edit' , compact('category'));
    }

    public function update(Request $request) {
        $request->validate( [
            'category_name' => 'required',
            'category_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ] );

        $category = Category::findOrFail($request->id);

        $data = [
            'category_name' => $request->category_name,
            'slug' => Str::slug($request->name),
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category', 'public');
            $data['category_img'] = $imagePath;
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
}
