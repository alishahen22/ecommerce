@extends('admin.master')
@section('title' ,'تعديل منتج')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">تعديل منتج</h1>
@if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
{{-- اظهار الايرور من الفاليداشن --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error )
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- نهاية اظهار الايرور من الفاليداشن --}}

<form id="storeForm" action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-6 form-group">
            <label for="">العنوان عربي</label>
            <input class="form-control" name="title_ar" value="{{old('title_ar',$product->title_ar)}}">
        </div>
        <div class="col-6 form-group">
            <label for="">العنوان انجليزي</label>
            <input class="form-control" name="title_en" value="{{old('title_en',$product->title_en)}}">
        </div>
    </div>
    <div class="row">
        <div class="col-6 form-group">
            <label for="">القسم</label>
            <select name="category_id" class="form-control">
                @foreach(\App\Models\Category::all() as $cat)
                    <option {{old('category_id',$product->category_id) == $cat->id ? "selected":""}} value="{{$cat->id}}">{{$cat->title_en}} - {{$cat->title_ar}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 form-group">
            <label for="">تاجات</label>
            <select name="tags[]" multiple class="form-control">
                @foreach(\App\Models\Tag::all() as $tag)
                    <option  {{$product->tags->contains($tag) ? "selected" :""}} value="{{$tag->id}}">{{$tag->title_en}} - {{$tag->title_ar}}</option>
                @endforeach
            </select>
        </div>
        {{-- <div class="col-6 form-group">
            <label for="">المقاسات</label>
            <select name="sizes[]" multiple class="form-control">
                @foreach(\App\Models\CategorySize::query()->where('category_id',$product->category_id)->get() as $size)
                    <option  {{$product->sizes->contains($size) ? "selected" :""}} value="{{$size->id}}">{{$size->value}}</option>
                @endforeach
            </select>
        </div> --}}

    </div>
    <div class="row">
        <div class="col-6 form-group">
            <label for="">الوصف عربي</label>
            <textarea class="form-control" name="description_ar" >{{old('description_ar',$product->description_ar)}}</textarea>
        </div>
        <div class="col-6 form-group">
            <label for="">الوصف انجليزي</label>
            <textarea class="form-control" name="description_en" >{{old('description_en',$product->description_en)}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-6 form-group">
            <label for="">السعر</label>
            <input class="form-control" name="price" value="{{old('price',$product->price)}}">
        </div>
        <div class="form-group col-6">
            <label for="">صورة اساسية</label>
            @if($product->main_image)
                <img height="100" src="{{asset('storage/'.$product->main_image)}}">
            @else
                بدون صورة
            @endif
            <input class="form-control" type="file" name="main_image" >
        </div>

           @if ($product->color)
           <div class="col-6 ">
           <label for="exampleColorInput" class="form-label"> اختر اللون</label>
           <input name="color" type="color" class="form-control form-control-color" id="exampleColorInput"  value="{{$product->color}}" title="Choose your color">
                </div>
                @else
                لا يوجد لون لهذا المنتج
           @endif
    </div>
    <button type="submit" class="btn btn-primary">تعديل</button>
</form>
    <hr>
  <h3 class="text-center">اضافة اكتر من صورة للمنتج</h3>

<div class="row d-flex justify-content-center align-items-center">
    <div class="col-6 form-group text-center ">
        <form  id='insertImage' method="POST" action="{{ route('product.add-images') }}" enctype="multipart/form-data">
            @csrf
            <input class="form-control" type="file" name="images[]" multiple>
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <button  class="btn btn-primary m-3" type="submit" name=""> تحميل صور </button>
        </form>
    </div>
</div>
    <div class="row mb-3" >
        <div class="col-12"><h5>الصور الحالية</h5></div>
        @forelse ($product->images as $image )
        <div class="col-3 form-group ">
            <img width="100px" src="{{ asset('storage/'.$image->path) }}" alt="">

                <a href="#"
                data-id={{$image->id}}
                class="btn btn-danger btn-sm delete"
                data-toggle="modal"
                data-target="#exampleModalCentered"><i class="fa fa-trash"> </i></a>
        </div>
        @empty
        <div class="col-12 form-group text-center ">
            <h4 class="">لا يوجد صور فرعية للمنتج</h4>
        @endforelse


</div>
    </div>
    <hr>
    <h3 class="text-center">اضافة خاصية مميزة للمنتج</h3>

    <form action="{{ route('product.add-props') }}" method="post">
        @csrf
     <div class="row" id="props">
        <div class="form-group col-3">
            <label for="">عنوان عربي</label>
            <input class="form-control" type="text" name="key_ar" >
        </div>
        <div class="form-group col-3">
            <label for="">قيمة عربي</label>
            <input class="form-control" type="text" name="value_ar" >
        </div>
        <div class="form-group col-3">
            <label for="">عنوان انجليزي</label>
            <input class="form-control" type="text" name="key_en" >
        </div>
        <div class="form-group col-3">
            <label for="">قيمة انجليزي</label>
            <input class="form-control" type="text" name="value_en" >
        </div>
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <div class="col-4">
            <button class="btn btn-primary m-4" > اضافة خاصية</button>

        </div>
    </form>
    </div>

    {{-- انهاء خاصية و لون --}}
    @if (session()->has('successProp'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('successProp') }}
    </div>
@endif
<div class="row">
    <div class="col-12 mt-5"><h5>خصائص المنتج</h5></div>
    @forelse($product->props as $prop)
        <form class="col-8" id="updateProp{{$prop->id}}" method="post" action="{{ route('product.update-prop' ,$prop->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-3">
                    <label for="">عنوان عربي</label>
                    <input class="form-control" type="text" name="key_ar" value="{{$prop->key_ar}}" >
                </div>
                <div class="form-group col-3">
                    <label for="">قيمة عربي</label>
                    <input class="form-control" type="text" name="value_ar" value="{{$prop->value_ar}}" >
                </div>
                <div class="form-group col-3">
                    <label for="">عنوان انجليزي</label>
                    <input class="form-control" type="text" name="key_en" value="{{$prop->key_en}}" >
                </div>
                <div class="form-group col-3">
                    <label for="">قيمة انجليزي</label>
                    <input class="form-control" type="text" name="value_en" value="{{$prop->value_en}}" >
                </div>
            </div>
        </form>

    <div class="form-group col-4">
        <label for="">ادارة</label>
        <br>
        <button form="updateProp{{$prop->id}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
        <button form="deleteProp{{$prop->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        <form id="deleteProp{{$prop->id}}" action="{{ route('product.delete-prop' ,$prop->id) }}" method="post">@csrf @method('delete')</form>
    </div>
    @empty
        <div class="col-12 mb-5">
            <h4 class="text-center">لا يوجد
            </h4>
        </div>
    @endforelse
</div>
{{--
<div class="row">
    <div class="col-12"><h5>الوان المنتج</h5></div>
    @forelse($product->colors as $color)
        <form class="col-8" id="updateColor{{$prop->id}}" method="post" action="{{route('admin.product_colors.update',$prop->id)}}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-3">
                    <label for="">اللون عربي</label>
                    <input class="form-control" type="text" name="color_ar" value="{{$color->color_ar}}">
                </div>
                <div class="form-group col-3">
                    <label for="">اللون انجليزي</label>
                    <input class="form-control" type="text" name="color_en" value="{{$color->color_en}}">
                </div>
            </div>
        </form>

        <div class="form-group col-4">
            <label for="">ادارة</label>
            <br>
            <button form="updateColor{{$color->id}}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
            <button form="deleteColor{{$color->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            <form id="deleteColor{{$color->id}}" action="{{route('admin.product_colors.destroy',$color->id)}}" method="post">@csrf @method('delete')</form>
        </div>
    @empty
        <div class="col-12">
            <h4>لا يوجد
            </h4>
        </div>
    @endforelse
</div>
<div class="row">
    <div class="col-12"><h5>صور المنتج</h5></div>
    <div class="col-12">
        <form method="post" action="{{route('admin.product_images.store')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="file" name="image" class="form-control">
            <button type="submit" class="btn btn-success">اضافة</button>
        </form>
    </div>
    @forelse($product->images as $image)
    <div class="col-4">
        <img height="100" src="{{asset('storage/'.$image->path)}}">
    </div>
    <div class="form-group col-8">
        <button form="deleteProp{{$image->id}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
        <form id="deleteProp{{$image->id}}" action="{{route('admin.product_images.destroy',$image->id)}}" method="post">@csrf @method('delete')</form>
    </div>
    @empty
        <div class="col-12">
            <h4>لا يوجد</h4>
        </div>
    @endforelse
</div>
</div> --}}
{{-- <div class="card-footer">
<button type="submit" class="btn btn-primary" form="storeForm">حفظ</button>
</div> --}}

{{-- model --}}
<div class="modal fade" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">حذف المنتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          <form id="form" action="{{ route('product.delete-image' , 'delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">


                <p class="text-center">هل أنت متأكد أنك تريد حذف هذا المنتج ؟</p>
                <input id="id" name="id" hidden>
            </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <input  type="submit" for='form' class="btn btn-danger" value="حذف" >

        </form>
        </div>
    </div>
</div>
</div>
@endsection

@section('js')
<script>
    $(document).on('click','.delete',function(){
         let id = $(this).attr('data-id');
         $('#id').val(id);

    });


</script>
@endsection
