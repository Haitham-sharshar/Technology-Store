@extends('front.layouts.master')

@section('content')
   <h2>User Profile</h2>
    <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2" style="color: red" >User Details
                <a href="{{url('user/edit'.'/'.$user->id)}}" class="pull-right">
                    <i class="fa fa-edit"></i>
                    Edit Profile
                </a>
            </th>

          </tr>
        </thead>
        <tr>
            <th>ID</th>
            <td>{{$user->id}}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>email</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Registered At</th>
            <td>{{$user->created_at}}</td>
        </tr>

    </table>

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

               </tr>
               </thead>
               <tbody>
               @foreach($user->order as $order)
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

                   </tr>
               @endforeach
               </tbody>
           </table>

       </div>
   </div>

@endsection