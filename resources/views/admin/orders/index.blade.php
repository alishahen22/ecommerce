@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">الطلبات</h1>

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">بيانات العميل</th>
        <th scope="col">بيانات الاتصال</th>
        <th scope="col">اجمالي الطلب</th>
        <th scope="col">حالة الطلب</th>
        <th scope="col">ادارة</th>

      </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $order->full_name }} <br>{{ $order->full_address }}</td>
            <td>{{ $order->phone }} <br> {{ $order->email }}</td>
            <td>{{ $order->total }}</td>
            <td>
                @if ($order->status == 'pending')
                <span class="badge badge-warning">قيد المراجعة</span>
                @elseif($order->status == 'shipping')
                <span class="badge badge-success">تم الشحن</span>
                @elseif($order->status == 'rejected')
                <span class="badge badge-danger">تم الالغاء</span>
                @elseif ($order->status == 'delivered')
                <span class="badge badge-info">تم التوصيل</span>
                @endif

            <td>
                <a class="btn btn-info btn-sm" href="{{ route('order.show' , $order->id) }}"><i class="fa fa-eye"> </i></a>

            </td>
          </tr>

        @empty
        <tr>
            <td colspan="50" class="text-center">لا يوجد بيانات</td>
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
                <h5 class="modal-title" id="exampleModalCenteredLabel">حذف المشرف</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
          <form id="form" action="{{ route('category.destroy' , 'delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">


                <p class="text-center">هل أنت متأكد أنك تريد حذف هذه الفئة ؟</p>
                <input id="id" name="id" hidden>
            </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <input  type="submit" for='form' class="btn btn-danger" value="حذف" >

        </form>
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



