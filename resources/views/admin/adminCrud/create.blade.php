@extends('admin.master')
@section('title' ,'اضافة مشرف')

@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">اضافة مشرفين</h1>
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

<form  method="POST" action="{{ route('admin.store') }}">
    @csrf
    <div class="form-group">
      <label for="name">اسم المشرف</label>
      <input type="text" class="form-control" id="name" name='name' placeholder="أدخل اسم المشرف" value="{{ old('name') }}">
    </div>
    <div class="form-group">
      <label for="code">الكود</label>
      <input type="text" class="form-control" id="code" name="code" placeholder="أدخل الكود" value="{{ old('code') }}" >
    </div>
    <div class="form-group">
      <label for="password">كلمة المرور</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="أدخل كلمة المرور">
    </div>
    <button type="submit" class="btn btn-primary">إضافة</button>
  </form>
@endsection

