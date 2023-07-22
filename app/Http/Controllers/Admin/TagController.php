<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $tags = Tag::all();
         return view('admin.tag.index', compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
              return view('admin.tag.create');
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
           'title_ar' => 'required|unique:categories|max:255',       ]);

         $tag = new Tag();
            $tag->title_en = $request->title_en;
            $tag->title_ar = $request->title_ar;
            $tag->save();
            return redirect()->route('tag.index')->with('success', 'تم اضافة القسم بنجاح');;
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
        $tag = Tag::findOrFail($id);
        return  view('admin.tag.edit', compact('tag'));

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
        ]);


        $tag = Tag::findOrFail($id);
        $tag->title_en = $request->title_en;
        $tag->title_ar = $request->title_ar;
        $tag->save();
        return redirect()->route('tag.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Tag::findOrFail($request->id)->delete();
        return redirect()->route('tag.index')->with('successDelete', 'تم حذف القسم بنجاح');
    }
}
