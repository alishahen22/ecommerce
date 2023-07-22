@extends('admin.master')
@section('title' ,'لوحة التحكم')
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
<div class="text-right mb-2">
    <a href="{{ route('product.create') }}" class="btn btn-success">اضافة منتح</a>
</div>
<table  class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">الاسم </th>
        <th scope="col">السعر</th>
        <th scope="col">الكمية</th>
        <th scope="col">الفئة التابع لها</th>
        <th scope="col">التاجات التابع لها </th>
        <th scope="col">الصورة</th>
        <th scope="col">ادارة</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $product->title_en }} - {{ $product->title_ar }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->category->title_ar }} - {{  $product->category->title_en }}</td>
            <td>
                @forelse ($product->tags as $tag )
                    {{ $tag->title_ar }} -
                @empty
                    لا يوجد تاجات
                @endforelse
            <td><img width="100" src="{{ asset('storage/'. $product->main_image ) }}" alt=""></td>

            <td>
                <a class="btn btn-info btn-sm" href="{{ route('product.edit' , $product->id) }}"><i class="fa fa-edit"> </i></a>
                <a href="#"
                data-id={{$product->id}}
                class="btn btn-danger btn-sm delete"
                data-toggle="modal"
                data-target="#exampleModalCentered"><i class="fa fa-trash"> </i></a>
            </td>
          </tr>

        @empty
        <tr>
            <td colspan="7" class="text-center">لا يوجد بيانات</td>
        </tr>
        @endforelse


    </tbody>
  </table>

  {{-- modal --}}


  <!-- Modal -->
 <!-- Modal -->
 <div class="modal fade" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">حذف المنتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          <form id="form" action="{{ route('product.destroy' , 'delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">


                <p class="text-center">هل أنت متأكد أنك تريد حذف هذا المنتج ؟</p>
                <input id="id" name="id" hidden>
            </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <input  type="submit" for='form' class="btn btn-danger" value="حذف" >

        </form>
        </div>
    </div>
</div>
</div>


@endsection

@section('js')
<script>
    $(document).on('click','.delete',function(){
         let id = $(this).attr('data-id');
         $('#id').val(id);

    });


</script>
@endsection
