@extends('admin.master')
@section('title' ,'لوحة التحكم')

@section('content')
@if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
    </div>
@endif
<h3 class="text-center">اضافة كمية لمنتج ({{ $product->title_ar }}) </h3>
<a  class='btn btn-success mb-4' href="{{ route('product.SelectProduct') }}">الرجوع</a>
<form action="{{ route('product.storeQuentity') }}" method="post">
    @csrf
    {{-- @if (count($product->features) == 0)

    <div class="alert alert-danger text-center" role="alert">
        لا يوجد مميزات لهذا المنتج
    </div>
    @else
    @endif --}}
    <div class="row">

        <label >اختار الحجم</label>
        <select class="form-control" name="size">
            <option value="">لا يوجد حجم</option>
            @foreach ($sizes as $size)
            <option value="{{ $size->id }}">{{ $size->size_ar }}</option>
            @endforeach
        </select>
        <br>
        </div>
        <input type="hidden" class="form-control" name="product_id" value="{{ $product->id }}" >
        <div class="row mb-3">
            <div class="col-3 ">

                    <label>الكمية</label>
                    <input type="number" class="form-control" name="quentity" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ادخل الكمية">

            </div>




        </div>
        <button type="submit" class="btn btn-primary">اضافة</button>

</form>




@endsection


