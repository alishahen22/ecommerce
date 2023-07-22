@extends('admin.master')
@section('title' ,'تعديل شعار')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">تعديل شعار</h1>
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

<form  method="POST" action="{{ route('tag.update', $tag->id ) }} ">
    @method('PUT')
    @csrf
    <div class="form-group">
        <label for="name">اسم الفئة بالعربي</label>
        <input type="text" class="form-control" id="name" name='title_ar' placeholder="أدخل اسم الفئة بالعربي" value="{{ $tag->title_ar }}">
      </div>
      <div class="form-group">
          <label for="name">اسم الفئة بالانجليزي</label>
          <input type="text" class="form-control" id="name" name='title_en' placeholder="أدخل اسم الفئة بالانجليزي" value="{{$tag->title_en }}">
        </div>


      <button type="submit" class="btn btn-primary">تعديل</button>

  </form>
@endsection

