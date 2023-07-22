@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center"> اضافة قيم لخاصية ( {{ $feature->name_ar }}) </h1>
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
<a class="btn btn-primary" href="{{ route('feature.index') }}">رجوع للخلف</a>
<form id="createForm"  action="{{route('feature.values.store')}}" method="post">
    @csrf
    <h3>اضافة قيم جديدة</h3>

    <div class="row mb-5">

      <div class="col-5">
        <input type="hidden" name="id" value="{{ $feature->id }}">

          <input placeholder="القيمة بالانجليزي" class="form-control" name="value_en" value="{{old('value_en')}}">
    </div>
    <div class="col-5">
        <input placeholder="القيمة بالعربي " class="form-control" name="value_ar" value="{{old('value_ar')}}">
    </div>
    <div class="col-2">
        <button form="createForm" type="submit" class="btn btn-success">اضافة</button>
    </div>
    </div>

    </div>

</form>
<div class="row">
    <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>الاسم بالعربي</th>
                <th>الاسم بالانجليزي</th>
                <th>ادارة</th>
            </tr>
        </thead>
        <tbody >
            @forelse($values as $value)
                <tr>
                    <th>{{ $loop->index+1 }}</th>
                    <th>{{$value->value_en}}</th>
                    <th>{{$value->value_ar}}</th>
                    <th>
                        <button form="delete{{$value->id}}" class="btn btn-danger btn-sm">حذف</button>
                        <form id="delete{{$value->id}}" action="{{route('feature.values.delete',$value->id)}}" method="post">@csrf @method('delete')</form>
                    </th>
                </tr>
            @empty
                <tr>
                    <th colspan="5">
                        لا توجد قيم لهذه الخاصية
                    </th>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>


</div>
@endsection



