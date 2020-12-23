@extends('admin.layouts.master');

@section('page')
    User Details
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
                            <th>Order Id</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th>Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
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
                                    @foreach($order->OrderItems as $item)
                                        <li> {{$item->price}} </li>
                                    @endforeach
                                </td>
                                <td>{{$order->date}}</td>

                                <td>
                                    @if($order->status)
                                        <span class="label label-success">Confirmed</span>
                                    @else
                                        <span class="label label-warning">pending</span>
                                    @endif
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