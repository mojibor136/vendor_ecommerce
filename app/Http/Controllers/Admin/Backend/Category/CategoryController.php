<?php

namespace App\Http\Controllers\Admin\Backend\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BackEnd\Category;
use App\Models\BackEnd\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.backend.category.index');
    }

    public function api(Request $request)
    {
        $query = $request->input('search');

        $categories = Category::when($query, function ($q) use ($query) {
            return $q->where('category_name', 'LIKE', "%$query%");
        })->latest()->paginate(7);

        return response()->json($categories);
    }

    public function create()
    {
        return view('admin.backend.category.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:255',
                'optimized_image' => 'required|string',
            ]);

            $existingCategory = Category::where('category_name', $request->category_name)->first();

            if ($existingCategory) {
                return back()->withInput()->with('error', 'Category already exists.');
            }

            $base64 = $request->optimized_image;
            preg_match("/data:image\/webp;base64,(.*)/", $base64, $matches);

            if (!isset($matches[1])) {
                return back()->withInput()->with('error', 'Invalid image format.');
            }

            $imageData = base64_decode($matches[1]);
            $imageName = Str::random(7) . '.webp';
            $imagePath = "category/{$imageName}";

            Storage::disk('public')->put($imagePath, $imageData);

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

    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return redirect()->route('categories.index')->with('error', 'Category not found.');
            }

            SubCategory::where('category_id', $id)->delete();

            if ($category->category_img && Storage::disk('public')->exists($category->category_img)) {
                Storage::disk('public')->delete($category->category_img);
            }

            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.backend.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.backend.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
            'optimized_image' => 'nullable|string',
        ]);

        try {
            $category = Category::findOrFail($request->id);

            $data = [
                'category_name' => $request->category_name,
                'slug' => Str::slug($request->category_name),
            ];

            if ($request->filled('optimized_image')) {
                if ($category->category_img && Storage::disk('public')->exists($category->category_img)) {
                    Storage::disk('public')->delete($category->category_img);
                }

                $base64 = $request->optimized_image;
                preg_match("/data:image\/webp;base64,(.*)/", $base64, $matches);

                if (!isset($matches[1])) {
                    return back()->withInput()->with('error', 'Invalid image format.');
                }

                $imageData = base64_decode($matches[1]);
                $imageName = Str::random(7) . '.webp';
                Storage::disk('public')->put("category/{$imageName}", $imageData);

                $data['category_img'] = "category/{$imageName}";
            }

            $category->update($data);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()->with('error', 'Slug already exists. Please choose a different category name.');
            }

            return redirect()->back()->with('error', 'An error occurred while updating the category.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage());
        }
    }
}
