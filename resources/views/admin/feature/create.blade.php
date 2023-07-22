@extends('admin.master')
@section('title' ,'اضافة فئة')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">اضافة اسلايدر</h1>
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

<form  method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">اسم العنوان الصغير بالعربي</label>
      <input type="text" class="form-control" id="name" name='small_title_ar'  value="{{ old('small_title_ar') }}">
    </div>
    <div class="form-group">
        <label for="name">اسم العنوان الصغير بالانجليزي</label>
        <input type="text" class="form-control" id="name" name='small_title_en'  value="{{ old('small_title_en') }}">
      </div>
      <div class="form-group">
        <label for="name">اسم العنوان الكبير بالعربي</label>
        <input type="text" class="form-control" id="name" name='big_title_ar'  value="{{ old('big_title_ar') }}">
      </div>
      <div class="form-group">
        <label for="name">اسم العنوان الكبير بالانجليزي</label>
        <input type="text" class="form-control" id="name" name='big_title_en'  value="{{ old('big_title_en') }}">
      </div>
    <div class="form-group">
        <label >اضافة صورة</label>
      <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1" value="{{ old('image') }}">
    </div>

    <button type="submit" class="btn btn-primary">إضافة</button>
  </form>
@endsection

