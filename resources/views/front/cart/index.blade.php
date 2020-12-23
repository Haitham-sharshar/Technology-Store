@extends('front.layouts.master')

@section('content')

        <h2 class="mt-5"><i class="fa fa-shopping-cart"></i> Shooping Cart</h2>
        <hr>
        @if (Cart::instance('default')->count()>0)

        <h4 class="mt-5">{{Cart::instance('default')->count()}} items(s) in Shopping Cart</h4>

        <div class="cart-items">

            <div class="row">

                <div class="col-md-12">

                @if (session()->has('msg'))
                  <div class="alert alert-success">
                        {{session()->get('msg')}}
                  </div>
              @endif
                    <div class="col-md-12">

                        @if (session()->has('errors'))
                            <div class="alert alert-success">
                                {{session()->get('erroes')}}
                            </div>
                        @endif
                    <table class="table">

                        <tbody>
                       @foreach(Cart::instance('default')->content() as $item)
                        <tr>
                            <td><img src="/uploades/{{$item->model->image}}" style="width: 5em"></td>
                            <td>
                                <strong>{{$item->name}}</strong><br> {{$item->model->description}}
                            </td>

                            <td>
                          <form action="{{route('cart.destroy',$item->rowId)}}" method="post">
                              @csrf
                              @method('delete')
                                <button type="submit" class="btn btn-link btn-link-dark">Remove</button><br>
                          </form>
                                <form action="{{route('cart.saveLater',$item->rowId)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-link btn-link-dark">Save For Later</button><br>
                                </form>


                            </td>

                            <td>
                                <select name="" id="" class="form-control quantity" data-id="{{$item->rowId}}" style="width: 4.7em">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>

                            <td>{{$item->total()}}</td>
                        </tr>

                     @endforeach
                        </tbody>

                    </table>

                </div>
                <!-- Price Details -->
                <div class="col-md-6">
                    <div class="sub-total">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th colspan="2">Price Details</th>
                            </tr>
                            </thead>
                            <tr>
                                <td>Subtotal </td>
                                <td>{{Cart::subtotal()}} </td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>{{Cart::tax()}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th>{{Cart::total()}}</th>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Save for later  -->
                <div class="col-md-12">
                    <a href="/" class="btn btn-outline-dark">Continue Shopping</a>
                    <a href="/checkout" class="btn btn-outline-info">Proceed to checkout</a>
                    <hr>

                </div>
     @else
         <h3> There is no items in your Cart</h3>
        <a href="/" class="btn btn-outline-dark">Continue Shopping</a>
         <hr>
 @endif
        @if (Cart::instance('saveForLater')->count()>0)
                <div class="col-md-12">
                    @if (session()->has('msg'))
                        <div class="alert alert-success">
                            {{session()->get('msg')}}
                        </div>
                    @endif

                    <h4>{{Cart::instance('saveForLater')->count()}} items Save for Later</h4>
                    <table class="table">

                        <tbody>

                        @foreach(Cart::instance('saveForLater')->content() as $item)
                            <tr>
                                <td><img src="/uploades/{{$item->model->image}}" style="width: 5em"></td>
                                <td>
                                    <strong>{{$item->name}}</strong><br> {{$item->model->description}}
                                </td>

                                <td>
                                    <form action="{{route('saveLater.destroy',$item->rowId)}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-link btn-link-dark">Remove</button><br>
                                    </form>
                                    <form action="{{route('moveToCart',$item->rowId)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-link-dark">Move To Cart</button><br>
                                    </form>

                                </td>

                                <td>
                                    <select name="" id="" class="form-control quantity" data-id="{{$item->rowId}}" style="width: 4.7em">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                                <td>{{$item->total()}}</td>
                            </tr>
                        @endforeach



                        </tbody>

                    </table>

                </div>
                @else
                  <h3> There is no items in Save for Later</h3>
                  <hr>
        @endif
            </div>


        </div>
    @endsection
@section('script')
    <script>
        const className = document.querySelectorAll('.quantity');
        Array.from(className).forEach(function($el){
            el.addEventListener('change',function(){
            const id = el.getAttribute('data-id');
                $.ajax({
                   headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                  type:"patch",
                   url: '/cart/update/'+id,
                   data:{id:id , quantity:this.value},
                   dataType:'json',
                   success:function(data)
                   {
                      location.reload();
                   }
                });
            });
        });




    </script>
    @endsection