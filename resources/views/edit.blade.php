@extends('layouts.app')
@section('content')
<body>
    <div class="container">

        <form action="{{ route('products.update',$product->id) }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
                        {!! csrf_field() !!}
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                       
                        <div class="row">
                            <div class="col-md-5">
                                <strong>{{(trans('lang.title'))}}</strong>
                                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                            </div>
                            
                            <div class="col-md-5">
                                <strong>{{(trans('lang.price'))}}</strong>
                                <input type="text" name="price" class="form-control" value="{{$product->price}}">
                            </div>
                            <div class="col-md-5">
                                <strong>{{(trans('lang.discount'))}}</strong>
                                <input type="text" name="discount" class="form-control" value="{{$product->discount}}">
                            </div>
                            <div class="col-md-5">
                                <strong>{{(trans('lang.stock'))}}</strong>
                                <input type="number" name="stock" class="form-control" value="{{$product->stock}}">
                            </div>
                            <div class="col-md-5">
                                <strong>{{(trans('lang.image'))}}</strong>
                                <!-- <input type="file" name="image" class="form-control"> 
                                -->
                                <br><br>
                                <strong>Current Image:</strong><img class="img-responsive" alt="" src="/images/{{ $product->image }}" style="height: 100px;width: 100px" /></td>
                                <input type="file" class="form-control-file" name="image">

                            </div>
                            <div class="col-md-2">
                                <br/>
                                <button type="submit" class="btn btn-success">{{(trans('lang.upload'))}}</button>
                            </div>
                        </div>
            </form>
        </div>
    </body>
    @endsection

                      