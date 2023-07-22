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
<table  class="table table-striped">
    <tr>
        <th>الخواص</th>
        <th>الكمية</th>

    </tr>
@foreach ($quentities as $quentity)
    <tr>

<td>{{ $quentity->size->size_ar ?? 'لا يوجد حجم ' }}</td>
<td>{{ $quentity->quentity }}</td>

@endforeach

</tr>
<tr>

    <td>
      <B>  الاجمالي</B>
    </td>
    <td>
        {{ $quentities->sum('quentity') }}
</tr>

</table>





{{-- @foreach ($quentities as $quentity)
 <select name="" id="">

    @foreach ( $quentity->features as $key=>$value)
    <option value="{{ $value }}">{{ \App\Models\Feature::find($key)->name_ar }} : {{ \App\Models\FeatureValue::find($value)->value_ar }}</option>
    @endforeach



 </select>
 @endforeach


{{--TESt  --}}


 @endsection
