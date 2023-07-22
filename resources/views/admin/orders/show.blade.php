@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">الطلبات</h1>
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
<div class="text-right mb-2">
    <a href="{{ route('orders.index') }}" class="btn btn-primary">رجوع</a>
</div>
<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">بيانات العميل</th>
        <th scope="col">بيانات الاتصال</th>
        <th scope="col">اجمالي الطلب</th>
        <th class="text-center" colspan="2" scope="col">حالة الطلب</th>

      </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $order->full_name }} <br>{{ $order->full_address }}</td>
            <td>{{ $order->phone }} <br> {{ $order->email }}</td>
            <td>{{ $order->total }}</td>
            <td>
                <form action="{{ route('status.update', $order->id ) }}" method="post">
                    @csrf
             <select  class="form-control " name="status" id="">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                    <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>تم الشحن</option>
                    <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>تم الالغاء</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تم التوصيل</option>
             </select>
            </td>
             <td><button type="submit" class="btn btn-success btn-sm">تحديث</button>

            </td>
        </form>
          </tr>
    </tbody>
  </table>
  <h2 class="h3 mb-4 text-gray-800 text-center">بيانات الطلب</h2>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">اسم المنتج</th>
        <th  scope="col"> الكمية</th>
        <th scope="col">سعر المنتح</th>
        <th  scope="col"> المقاس</th>
        <th  scope="col"> اجمالي</th>

      </tr>
    </thead>
    <tbody>

            @foreach ( $order->OrderItem as $item  )
            <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{ $item->product_name }} </td>
            <td>{{ $item->quantity }}</td>
            <td>{{ $item->product_price }}</td>
            <td> {{ $item->chosen_color  ?? 'لم يحدد'}} </td>
            <td> {{ $item->sub_total }} </td>
        </tr>
            @endforeach







    </tbody>
  </table>

@endsection



