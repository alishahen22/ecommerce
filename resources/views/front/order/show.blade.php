@extends('front.layouts.master')
@section('content')
    {{-- @isset($order) --}}
        <div class="container p-3 " style="margin-top: 110px">
            <h3>{{ __('front.basic_information') }}</h3>
            <div class="row">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>{{ __('front.customer_information') }}</th>
                        <th>{{ __('front.contact_information') }}</th>
                        <th>{{ __('front.order_total') }}</th>
                        <th>{{ __('front.order_status') }}</th>

                    </tr>
                    </thead>
                    <tbody >
                    <tr>
                        <th>{{$order->full_name}} <br> {{$order->full_address}}</th>
                        <th>{{$order->phone}} - {{$order->email}}</th>
                        <th>{{$order->total}}</th>

                            <th>{{__('front.'.$order->status)}}</th>                      </th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h4>{{ __('front.order_information') }}</h4>
            <div class="row">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>{{ __('front.product_name') }}</th>
                        <th>{{ __('front.product_price') }}</th>
                        <th>{{ __('front.size') }}</th>
                        <th>{{ __('front.quantity') }}</th>
                        <th>{{ __('front.total') }}</th>
                    </tr>
                    </thead>
                    <tbody >
                    @foreach($order->OrderItem as $item)
                        <tr>
                            <th>{{$loop->index+1}}</th>
                            <th>{{$item->product_name}}</th>
                            <th>{{$item->product_price}}</th>
                            <th>{{$item->chosen_size ?? __('front.not_specified')}}</th>
                            <th>{{$item->quantity}}</th>
                            <th>{{$item->sub_total}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{-- @if($order->tracks()->count())
            <h4>تتبع الطلب</h4>
            <div class="row">
                <table class="table table-bordered text-center">
                    <tbody >
                    @foreach($order->tracks as $track)
                        <tr>
                            <th>#{{$track->id}}</th>
                            <th>{{__('status.'.$track->status) }}</th>
                            <th>{{$track->message}}</th>
                            <th>{{$track->created_at->format('Y-m-d')}}</th>
                            <th>{{$track->created_at->format('h:i')}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @endif

    @else
    <div class="container">
        <h3>find your order by order code #</h3>
        <form>
            <input name="order_code" class="form-control" value="{{old('order_code')}}">
            <button class="btn btn-success">بحث</button>
        </form>
    </div>
    @endisset --}}
</div>
@endsection
