@extends('admin.master')


@section('title' ,'لوحة التحكم')
@section('content')
<h1 class="h3 mb-4 text-gray-800 text-center">تواصل معنا </h1>


<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">الاسم</th>
        <th scope="col">الايميل</th>
        <th scope="col">الرسالة</th>

      </tr>
    </thead>
    <tbody>
        @forelse ($contacts as $contact)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            <td>{{ $contact->name }}</td>
            <td>{{$contact->email }}</td>
            <td>{{$contact->message }}</td>
          </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center">لا يوجد رسائل</td>
        </tr>
        @endforelse


    </tbody>
  </table>

  {{-- modal --}}


  <!-- Modal -->
 <!-- Modal -->





@endsection

