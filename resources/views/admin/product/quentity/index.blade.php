@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection
@section('content')


<h1 class="h3 mb-4 text-gray-800 text-center">المنتجات</h1>
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

<table id="example" class="table table-striped" style="width:100%">
    <thead class="text-center">
        <tr>
            <td>#</td>
            <td>الاسم بالعربي</td>
            <td>الاسم بالانجليزي</td>
            <td>الكمية</td>
            <td>الاداراة</td>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($products as $product)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $product->title_ar }}</td>
            <td>{{ $product->title_en}}</td>
            <td>{{  $product->quentity()->sum('quentity') }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('product.showQuentityToProduct' , $product->id) }}">تفاصيل الكمية </a>

                <a class="btn btn-success" href="{{ route('product.addQuentityToProduct' , $product->id) }}">اضافة الكمية </a>
            </td>

        </tr>
        @endforeach
    </tbody>

</table>

@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection

