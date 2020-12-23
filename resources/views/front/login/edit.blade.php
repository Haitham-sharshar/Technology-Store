@extends('front.layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12" id="register">

            <div class="card col-md-8">
                <div class="card-body">
                    <h2 class="card-title">Edit</h2>
                    <hr>
                    @if($errors->any())
                        <div class="alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="user/edit" method="PUT">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" placeholder="Name" id="name" class="form-control" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" name="email" placeholder="Email" id="email" class="form-control" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="text" name="password" placeholder="Password" id="password" class="form-control" value="{{$user->password}}">
                        </div>




                        <div class="form-group">
                            <button class="btn btn-outline-info col-md-2"> update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>

    </div>
    @endsection
