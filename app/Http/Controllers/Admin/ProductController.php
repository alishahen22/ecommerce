<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Feature;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductProp;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $products = Product::all();
         return view('admin.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {         $tags = Tag::all();
            $categories = Category::all();
            // $features = Feature::all();
            return view('admin.product.create' , compact('tags','categories' ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title_ar'      =>  'required',
            'title_en'      =>  'required',
            'price'         =>  'required|numeric',
            'description_ar'        =>  'required',
            'description_en'        =>  'required',
            'main_image'            =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'           =>  'required|exists:categories,id',

        ]);

        $product = new Product();
            $product->title_en       =  $request->title_en;
            $product->title_ar       =  $request->title_ar;
            $product->price          =  $request->price;
            $product->description_ar =  $request->description_ar;
            $product->description_en =  $request->description_en;
            $product->category_id    =  $request->category_id;

        $image = Storage::disk('public')->put('images/products', $request->file('main_image'));

            $product->main_image = $image;
            if ($request->has('color')) {
                $product->color = $request->color;
            }
            $product->save();

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }



        return redirect()->route('product.edit',$product->id)->with('success', ' تم اضافة المنتج يمكنك اضافة صور وخصائص للمنتج الان');

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
         $product = Product::findOrFail($id);
         return  view('admin.product.edit', compact('product'));


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
        $this->validate($request,[
            'title_ar'              =>  'required',
            'title_en'              =>  'required',
            'price'                 =>  'required|alpha_num',
            'description_ar'        =>  'required',
            'description_en'        =>  'required',
            'main_image'            =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
            'category_id'           =>  'required|exists:categories,id',
        ]);


        $product = Product::findOrFail($id);
        $product->title_en       =  $request->title_en;
        $product->title_ar       =  $request->title_ar;
        $product->price          =  $request->price;
        $product->description_ar =  $request->description_ar;
        $product->description_en =  $request->description_en;
        $product->category_id    =  $request->category_id;
        $product->color          =  $request->color;

        //check if there is image
        if ( $request->hasFile('main_image')  ) {
            Storage::disk('public')->delete($product->main_image);
             $image = Storage::disk('public')->put('images/products', $request->file('main_image'));

             $product->main_image = $image;

        }

       $product->save();
       return redirect()->route('product.index')->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    public function destroy(Request $request,$id)
    {
        $request->validate([
            'id' => 'required|exists:products,id',
        ]);
        Product::findOrFail($request->id)->delete();
        return redirect()->route('product.index')->with('successDelete', 'تم حذف القسم بنجاح');
    }


        //save props from edit page
        public function saveProp(Request $request)
        {
            $request->validate([
                'key_ar' => 'required|',
                'key_en' => 'required|string',
                'value_ar' => 'required|string',
                'value_en' => 'required|string',
                'product_id' => 'required|exists:products,id',
            ]);

            $product = Product::findOrFail($request->product_id);
            $product->props()->create([
                'key_ar' => $request->key_ar,
                'key_en' => $request->key_en,
                'value_ar' => $request->value_ar,
                'value_en' => $request->value_en,
            ]);
            $product->save();
            return redirect()->to( route('product.edit' , $request->product_id).'/#props')->with('success', 'تم اضافة الخصائص بنجاح');



            }

            public function updateProp(Request $request , $id)
            {
                $request->validate([
                    'key_ar' => 'required|',
                    'key_en' => 'required|string',
                    'value_ar' => 'required|string',
                    'value_en' => 'required|string',
                ]);
                $prop = ProductProp::findOrFail($id);
                $prop->update([
                    'key_ar' => $request->key_ar,
                    'key_en' => $request->key_en,
                    'value_ar' => $request->value_ar,
                    'value_en' => $request->value_en,
                ]);
                return redirect()->to( route('product.edit' , $prop->product_id).'/#props')->with('successProp', 'تم تعديل الخصية بنجاح');
            }


        //delete props from edit page
        public function deleteProp($id)
        {
            $prop = ProductProp::findOrFail($id);
            $prop->delete();
            return redirect()->to( route('product.edit' , $prop->product_id).'/#props')->with('successProp', 'تم حذف الخصية بنجاح');
        }

            //save image in storage from edit page
    public function SaveImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $images = $request->file('images');
        $product = Product::findOrFail($request->product_id);
        foreach ($images as $image) {
            $image = Storage::disk('public')->put('images/products', $image);
            $product->images()->create(['path' => $image]);
        }
        $product->save();
      return back()->with('success', 'تم اضافة الصور بنجاح');
    return $request->all();

    }
    //delete image from edit page
    public function deleteImage(Request $request)
    {

        $image = ProductImage::findOrFail($request->id);
        Storage::disk('public')->delete($image->path);
        $image->delete();
        return back()->with('success', 'تم حذف الصورة بنجاح');
    }


}
