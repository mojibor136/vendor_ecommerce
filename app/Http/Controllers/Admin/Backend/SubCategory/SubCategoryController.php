<?php

namespace App\Http\Controllers\Admin\Backend\SubCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\BackEnd\SubCategory;
use App\Models\BackEnd\Category;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index() {
        return view( 'admin.backend.sub-category.index' );
    }

    public function getSubCategories($id){
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    public function api(Request $request) {
        $query = $request->input('search');
        $subcategories = SubCategory::with('category')->when($query, function ($q) use ($query) {
            return $q->where('subcategory_name', 'LIKE', "%$query%");
        })->latest()->paginate(7);
    
        return response()->json($subcategories);
    }

    public function create() {
        $categories = Category::all();
        return view( 'admin.backend.sub-category.create', compact( 'categories' ) );
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'subcategory_name' => 'required',
                'category_id' => 'required',
            ]);
    
            $category = Category::findOrFail($request->category_id);
    
            $exists = SubCategory::where('subcategory_name', $request->subcategory_name)->exists();
    
            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This subcategory name is already taken. Please choose a different name.');
            }
    
            SubCategory::create([
                'subcategory_name' => $request->subcategory_name,
                'category_id' => $category->id,
                'product_count' => 0,
                'slug' => Str::slug($request->subcategory_name),
            ]);
    
            $category->increment('subcategory_count', 1);
    
            return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    

    public function show($id){
        $subcategory = SubCategory::with('category')->findOrFail($id);
        return view('admin.backend.sub-category.show' , compact('subcategory'));
    }

    public function destroy($id) {
        $subcategory = SubCategory::findOrFail($id);
    
        Category::findOrFail($subcategory->category_id)->decrement('subcategory_count', 1);
    
        $subcategory->delete();
    
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }

    public function edit($id){
       $subcategory = SubCategory::findOrFail($id);
       $categories = Category::all();
       return view('admin.backend.sub-category.edit' , compact('subcategory' , 'categories'));
    }

    public function update(Request $request) {
        // Validation
        $request->validate([
            'id' => 'required|exists:sub_categories,id',
            'name' => 'required|string|max:255',
        ]);
    
        $subcategory = SubCategory::findOrFail($request->id);

         // Store the old category and subcategory
         $oldCategory = $subcategory->category_id;
    
        $subcategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
        ]);

        // Update category and subcategory product count if changed
        if ($oldCategory != $request->category_id) {
            Category::findOrFail($oldCategory)->decrement('subcategory_count', 1);
            Category::findOrFail($request->category_id)->increment('subcategory_count', 1);
        }
    
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }
}
