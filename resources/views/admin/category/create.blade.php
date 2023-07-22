@extends('admin.master')
@section('title' ,'اضافة فئة')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">اضافة فئات</h1>
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

<form  method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="name">اسم الفئة بالعربي</label>
      <input type="text" class="form-control" id="name" name='title_ar' placeholder="أدخل اسم الفئة بالعربي" value="{{ old('name_ar') }}">
    </div>
    <div class="form-group">
        <label for="name">اسم الفئة بالانجليزي</label>
        <input type="text" class="form-control" id="name" name='title_en' placeholder="أدخل اسم الفئة بالانجليزي" value="{{ old('name_en') }}">
      </div>
    <div class="form-group">
        <label >اضافة صورة</label>
      <input type="file" class="form-control-file" name="logo" id="exampleFormControlFile1" value="{{ old('logo') }}">
    </div>

    <button type="submit" class="btn btn-primary">إضافة</button>
  </form>
@endsection

