@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">خصائص مميزة للعناصر</h1>
@if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session()->has('successDelete'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('successDelete') }}
    </div>

@endif
<form id="createForm"  action="{{route('feature.store')}}" method="post">
    @csrf
    <h3>اضافة عناصر جديدة</h3>
    <div class="row mb-5">

      <div class="col-5">

     <input autofocus placeholder="الاسم بالانجليزي" class="form-control" name="name_en" value="{{old('name_en')}}">
    </div>
    <div class="col-5">
        <input placeholder="الاسم بالعربي " class="form-control" name="name_ar" value="{{old('name_ar')}}">
    </div>
    <div class="col-2">
        <button form="createForm" type="submit" class="btn btn-success">اضافة</button>
    </div>
    </div>

    </div>

</form>
    <h3>القيم المضافة حاليا</h3>
<div class="row">
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>الاسم بالعربي</th>
                <th>الاسم بالانجليزي</th>
                <th>عدد القيم</th>
                <th>ادارة</th>
            </tr>
        </thead>
        <tbody >
            @forelse($features as $feature)
                <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <th>{{$feature->name_en}}</th>
                    <th>{{$feature->name_ar}}</th>
                    <th>{{count($feature->values)}}</th>
                    <th>
                        <a class="btn btn-primary btn-sm" href="{{ route('feature.addValue' , $feature->id) }}"> اضافة قيم للخاصية</a>
                        <button form="delete{{$feature->id}}" class="btn btn-danger btn-sm">حذف</button>
                        <form id="delete{{$feature->id}}" action="{{route('feature.destroy',$feature->id)}}" method="post">@csrf @method('delete')</form>
                    </th>
                </tr>
            @empty
                <tr>
                    <th colspan="5">
                        لا توجد خصائص
                    </th>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>


</div>
@endsection
