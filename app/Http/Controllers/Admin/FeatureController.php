<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;
use App\Models\FeatureValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//delete it
class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $features = Feature::all();
        return view('admin.feature.index' ,compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name_en' => 'required',
            'name_ar' => 'required',

        ]);

       $feature =new Feature();
       $feature->name_en = $request->name_en;
       $feature->name_ar = $request->name_ar;
       $feature->save();
       return redirect()->back()->with('success', 'تم اضافة الخاصية بنجاح');

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Feature::FindOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم حذف الخاصية بنجاح');



    }

    //get index of values
    public function addValueToFeature($id)
    {

        $feature = Feature::FindOrFail($id);
        $values = FeatureValue::where('feature_id', $id)->get();
        return view('admin.feature.values' ,compact('feature' , 'values'));

    }

    public function storeValueToFeature(Request $request)
    {
        $request->validate([
            'value_en' => 'required',
            'value_ar' => 'required',
            'id'       => 'required|exists:features,id',
        ]);

        $value = new FeatureValue();
        $value->value_en = $request->value_en;
        $value->value_ar = $request->value_ar;
        $value->feature_id = $request->id;
        $value->save();

       return redirect()->back()->with('success', 'تم اضافة القيمة بنجاح');

    }
    public function deleteValue($id)
    {
        FeatureValue::FindOrFail($id)->delete();
        return redirect()->back()->with('success', 'تم حذف القيمة بنجاح');

    }

}
