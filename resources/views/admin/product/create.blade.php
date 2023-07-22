@extends('admin.master')
@section('title' ,'اضافة منتج')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">اضافة منتجات</h1>
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

<div class="card-body">
    <form id="storeForm" action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6 form-group">
                <label for="">العنوان عربي</label>
                <input class="form-control" name="title_ar" value="{{old('title_ar')}}">
            </div>
            <div class="col-6 form-group">
                <label for="">العنوان انجليزي</label>
                <input class="form-control" name="title_en" value="{{old('title_en')}}">
            </div>
        </div>
        <div class="row">


            <div class="col-6 form-group">
                <label for="">تاجات</label>
                <select name="tags[]" multiple class="form-control">
                    @foreach ( $tags as $tag )
                     <option  {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag ->title_ar }} - {{ $tag ->title_en }}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-6 form-group">
                <label for="">السعر</label>
                <input class="form-control" name="price" value="{{old('price')}}">
            </div>
            <div class="col-6 form-group">
                <label for="" class="form-label"> اختر القسم</label>
                <select name="category_id" class="form-control">
                    <option value="">اختر القسم</option>
                    @foreach ( $categories as $category )

                    <option {{ old('category_id') == $category->id ? "selected" : "" }} value="{{ $category->id }}">
                        {{ $category->title_ar }} - {{ $category->title_en }}
                    </option>
                    @endforeach
                </select>
            </div>
        <div class="col-6 ">
         <label for="exampleColorInput" class="form-label"> اختر اللون</label>
          <input name="color" type="color" class="form-control form-control-color" id="exampleColorInput"  value="{{old('price')}} title="Choose your color">
               </div>
        </div>
        <div class="row">
            <div class="col-6 form-group">
                <label for="">الوصف عربي</label>
                <textarea class="form-control" name="description_ar" >{{old('description_ar')}}</textarea>
            </div>
            <div class="col-6 form-group">
                <label for="">الوصف انجليزي</label>
                <textarea class="form-control" name="description_en" >{{old('description_en')}}</textarea>
            </div>

        <div class="form-group">
            <label for="">صورة اساسية</label>
            <input class="form-control" type="file" name="main_image" >
        </div>
    </div>
    </form>
</div>
<div class="card-footer">
    <button type="submit" class="btn btn-primary" form="storeForm">ارسال</button>
</div>


@endsection

