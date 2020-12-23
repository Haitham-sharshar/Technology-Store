@extends('admin.layouts.master');

@section('page')
    Add Product
    @endsection

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-10">
            <div class="card">
                <div class="header">
                    <h4 class="title">Add Product</h4>
                </div>
                <div class="content">
                    @include('admin.layouts.message')
                    {!! Form::open(['url'=>'products','files'=>'true']) !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                    {{Form::label('product_name','Product Name')}}
                                    {{Form::text('name','',['class'=>'form-control border-input','placeholder'=>'Product name'])}}
                                    <span class="text-danger">
                                        {{$errors->has('name')?$errors->first('name'):''}}
                                    </span>
                                </div>

                                <div class="form-group {{$errors->has('price')?'has-error':''}}">
                                    {{Form::label('Price','Product Price')}}
                                    {{Form::text('price','',['class'=>'form-control border-input','placeholder'=>'Product Price'])}}
                                    <span class="text-danger">
                                        {{$errors->has('price')?$errors->first('price'):''}}
                                    </span>
                                </div>

                                <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                    {{Form::label('description','Product Description')}}
                                    {{Form::textarea('description','',['class'=>'form-control border-input','placeholder'=>'Description'])}}
                                    <span class="text-danger">
                                        {{$errors->has('description')?$errors->first('description'):''}}
                                    </span>
                                </div>

                                <div class="form-group {{$errors->has('image')?'has-error':''}}">
                                    {{Form::label('file','Product image')}}
                                    {{Form::file('image',['class'=>'form-control border-input','id'=>'image'])}}
                                    <div id="thumb-output"></div>
                                    <span class="text-danger">
                                        {{$errors->has('image')?$errors->first('image'):''}}
                                    </span>
                                </div>

                            </div>

                        </div>
                        <div class="">
                            {{Form::submit('Add Product',['class'=>'btn btn-info btn-fill btn-wd'])}}
                        </div>
                        <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection