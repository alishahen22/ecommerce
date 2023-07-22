@extends('front.layouts.master')
@section('content')
    <div class="container" style="margin-top: 110px">
        <h3 class="w-100">{{ __('front.my_orders')}}</h3>
        <br>
        <table class="table table-striped table-bordered text-center">
            <thead>
              <th>{{ __('front.order_number') }}</th>
              <th>{{ __('front.order_value') }}</th>
              <th>{{ __('front.item_count') }}</th>
              <th>{{ __('front.date') }}</th>
              <th>{{ __('front.time') }}</th>
              <th>{{ __('front.status') }}</th>
              <th>{{ __('front.order_details') }}</th>

            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$order->total}}</td>
                    <td>{{$order->OrderItem()->count()}}</td>
                    <td>{{$order->date}}</td>
                    <td>{{$order->time}}</td>
                    <td>{{__('front.'.$order->status)}}</td>
                    <td><a href = '{{ route('front.order.show' ,  $order->id ) }}' class="btn btn-info btn-sm"><i class="fa fa-eye"> </i></a></td>
                </tr>
                @empty
                    <tr><td colspan="1000">{{ __('front.no_orders_found') }}</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@stop
