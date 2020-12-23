@extends('admin.layouts.master');

@section('page')
    orders
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('admin.layouts.message')
            <div class="card">
                <div class="header">
                    <h4 class="title">Orders</h4>
                    <p class="category">List of all orders</p>
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>
                                @foreach($order->products as $item)
                                   <li> {{$item->name}} </li>
                                    @endforeach
                            </td>
                            <td>
                                @foreach($order->OrderItems as $item)
                                    <li> {{$item->quantity}} </li>
                                @endforeach
                            </td>

                            <td>
                                @if($order->status)
                                <span class="label label-success">Confirmed</span>
                                    @else
                                    <span class="label label-warning">pending</span>
                                    @endif
                            </td>
                            <td>
                                @if($order->status)
                                {{link_to_route('order.pending','pending',$order->id,['class'=>'btn btn-sm btn-warning ti-close'])}}
                                @else
                                {{link_to_route('order.confirm','confirm',$order->id,['class'=>'btn btn-sm btn-succes ti-close'])}}
                             @endif
                                {{link_to_route('orders.show','Details',$order->id,['class'=>'btn btn-sm btn-primary ti-view-list-alt'])}}

                            </td>
                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>
    </div>
    @endsection