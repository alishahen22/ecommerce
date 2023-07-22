<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuentityProduct;
use App\Models\Size;

class AddQuentityController extends Controller
{
    public function selectProduct()
    {
        $products = Product::all();


        return view('admin.product.quentity.index', compact('products'));
    }


    public function addQuentity($id)
    {
        $product = Product::findorFail($id);
        $sizes = Size::all();



        return view('admin.product.quentity.addQuentity', compact('product', 'sizes'));
    }

    public function storeQuentityToProduct(Request $request)
    {
        //validation
        $request->validate([
            'quentity' => 'required|numeric|min:1',

        ]);
        // $data = $request->except(['_token', 'product_id', 'quentity']);
        // //حذف القيم الفارغة الي هي قيم السيليكت الي اليوزر مخترهاش
        // $dataWithoutNull = array_filter($data, function ($value) {
        //     return !is_null($value);
        // });
        // //تحويل الداتا الي جيسون
        //  $jsonData = json_encode($dataWithoutNull);
        //  //البحث عن الداتا الي موجودة بالفعل عشان اضيف عليها لو موجودة
        //  $existingData = QuentityProduct::where('features', $jsonData)
        //  ->where('product_id', $request->product_id)
        //  ->first();
        //     if($existingData){
        //         $existingData->quentity += $request->quentity;
        //         $existingData->save();
        //        }
        //        else{
        //         //اضافة الداتا الجديدة
        //         $quentity = QuentityProduct::create([
        //             'product_id' => $request->product_id,
        //             'quentity' => $request->quentity,
        //             'features' => $jsonData,
        //         ]);
        //        }
        $quentity = QuentityProduct::where('product_id', $request->product_id)->where('size_id', $request->size)->first();
        if (!$quentity) {
            $quentity = QuentityProduct::create([
                'product_id' => $request->product_id,
                'quentity' => $request->quentity,
                'size_id' => $request->size,
            ]);
        } else {
            $quentity->quentity += $request->quentity;
            $quentity->save();
        }

        Product::where('id', $request->product_id)->increment('quantity', $request->quentity);


        return redirect()->route('product.addQuentityToProduct',$request->product_id)->with('success', 'تم اضافة الكمية بنجاح');


    }

    public function showQuentityToProduct($id)
    {
        $product = Product::findorFail($id);
       $quentities = QuentityProduct::with('size')->where('product_id', $id)->get();

    //    $quentities->transform(function ($quentity) {
    //     $features = json_decode($quentity->features, true);

    //     $quentity->features = $features;

    //     return $quentity;
    // });

    // $features = QuentityProduct::whereJsonContains('features', ['1' => '2'])
    // ->where('product_id', $id)->get();
         return view('admin.product.quentity.showQuentity', compact('product', 'quentities'));


    }


}
