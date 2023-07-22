<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
         return view('admin.slider.index', compact('sliders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([

            'small_title_ar' => 'required|max:255|unique:sliders,small_title_ar',
            'small_title_en' => 'required|max:255|unique:sliders,small_title_ar',
            'big_title_ar' => 'required|max:255',
            'big_title_en' => 'required|max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

        ]);

        $slider = new Slider();
        $slider->small_title_ar = $request->small_title_ar;
        $slider->small_title_en = $request->small_title_en;
        $slider->big_title_ar = $request->big_title_ar;
        $slider->big_title_en = $request->big_title_en;
        $image = Storage::disk('public')->put('images/sliders', $request->file('image'));
        $slider->image = $image;
        $slider->save();
        return redirect()->route('slider.index')->with('success', 'تم اضافة القسم بنجاح');;
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
    public function edit()
    {


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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Slider::findOrFail($request->id)->delete();
        return redirect()->route('slider.index')->with('successDelete', 'تم حذف القسم بنجاح');
    }
}
