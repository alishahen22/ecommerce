@extends('admin.master')
@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">الشعارات</h1>
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
    <a href="{{ route('tag.create') }}" class="btn btn-success">اضافة شعار</a>
</div>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">العنوان بالانجليزي</th>
        <th scope="col">العنوان بالعربي</th>
        <th scope="col">ادارة</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($tags as $tag)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $tag->title_en }}</td>
            <td>{{ $tag->title_ar }}</td>

            <td>
                <a class="btn btn-info btn-sm" href="{{ route('tag.edit' , $tag->id) }}"><i class="fa fa-edit"> </i></a>
                <a href="#"
                data-id={{$tag->id}}
                class="btn btn-danger btn-sm delete"
                data-toggle="modal"
                data-target="#exampleModalCentered"><i class="fa fa-trash"> </i></a>
            </td>
          </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center">لا يوجد بيانات</td>
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
          <form id="form" action="{{ route('tag.destroy' , 'delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-body">


                <p class="text-center">هل أنت متأكد أنك تريد حذف هذا الشعار ؟</p>
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



