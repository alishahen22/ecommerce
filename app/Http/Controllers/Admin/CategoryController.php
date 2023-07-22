<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Category::all();
         return view('admin.category.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request ->validate([
           'title_en' => 'required|unique:categories|max:255',
           'title_ar' => 'required|unique:categories|max:255',
           'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
       ]);

         $category = new Category();
            $category->title_en = $request->title_en;
            $category->title_ar = $request->title_ar;
            if ($request->hasFile('logo')) {
                $image = Storage::disk('public')->put('images/categories', $request->file('logo'));
                $category->logo = $image;
            }
            $category->save();
            return redirect()->route('category.index')->with('success', 'تم اضافة القسم بنجاح');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return  view('admin.category.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request ->validate([
            'title_en' => 'required|max:255|unique:categories,title_en,'.$id,
            'title_ar' => 'required|max:255||unique:categories,title_ar,'.$id,
            'logo' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);


        $category = Category::findOrFail($id);
        $category->title_en = $request->title_en;
        $category->title_ar = $request->title_ar;
        if ($request->hasFile('logo')) {
            $old_image = $category->logo;
            Storage::disk('public')->delete($old_image);
            $image = Storage::disk('public')->put('images/categories', $request->file('logo'));
            $category->logo = $image;
        }
        $category->save();
        return redirect()->route('category.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Category::findOrFail($request->id)->delete();
        return redirect()->route('category.index')->with('successDelete', 'تم حذف القسم بنجاح');
    }
}
