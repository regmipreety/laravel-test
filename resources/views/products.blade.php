@extends('layouts.app')
@section('content')
<body>
    <div class="container">
        <button class="btn btn-success" id="btn-create">Create Product</button>
        <h3>Products</h3>
        <div id="inputform">
            <form action="{{ url('products') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
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
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-5">
                        <strong>{{(trans('lang.title'))}}</strong>
                        <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Title">
                    </div>
                    
                    <div class="col-md-5">
                        <strong>{{(trans('lang.price'))}}</strong>
                        <input type="text" name="price" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <strong>{{(trans('lang.discount'))}}</strong>
                        <input type="text" name="discount" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <strong>{{(trans('lang.stock'))}}</strong>
                        <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="col-md-5">
                        <strong>{{(trans('lang.image'))}}</strong>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <br/>
                        <button type="submit" class="btn btn-success">{{(trans('lang.upload'))}}</button>
                    </div>
                </div>
            </form>
        </div>
        
            <span>Total:
                <div id="sumTotal"></div>
        </span>
   
        
        @if($products->count())
        <div class="row">
                
                    @foreach($products as $image)
            <div class="col-md-4 col-lg-4 col-xs-12">
<div class="panel panel-default">
                    <form action="{{ route('products.delete',$image->id) }}" method="GET">
                        <button type="submit" class="close-icon btn btn-danger pull-right"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                    
                    <div class="panel-body"><center><img class="img-responsive" style="height: 160px;widows: 100px;" alt="" src="/images/{{ $image->image }}" /></center></div>
                    
                    <div class="panel-footer">
                        <div class="row"><div class="col-xs-6">{{ $image->name }}</div>
                        <div class="col-xs-12 col-md-6">${{$image->price}}</div></div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-6 col-md-6"><a href="{{route('products.show',$image->id)}}" method="GET" class="btn btn-primary">View Details</a></div>
                                <div class="col-xs-6">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModel{{$image->id}}" data-id={{$image->price}}>
                                    Add To Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal " id="myModel{{$image->id}}" tabindex="-1" role="dialog" aria-labelledby="myModelTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">{{$image->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-xs-6">
                                            <input type="number" name="amount" placeholder="quanity" class="qty" data-price="{{$image->price}}">
                                        </div>
                                        <div class="form-group col-xs-6 total"><label>Total:</label></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary price" >Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
            </div>
                    @endforeach
                    
                
            @endif
            </div> <!-- list-group / end -->
            </div> <!-- row / end -->
 <script type="text/javascript">
     $(document).ready(function(){
            $('#inputform').hide();
         $('#btn-create').click(function(){
            $('#inputform').show();
        });
         var subtotal=0;
       $('.qty').on('change',function(){
        var qty=$(this).val();
        console.log('quantity'+qty);
            var unitPrice=$(this).data('price');
            var tot=qty*unitPrice;
            console.log('unitPrice'+unitPrice);
            $(this).closest('div').html(tot);
            console.log('item:'+tot);
            
            subtotal=subtotal+tot;
            $('#sumTotal').html(subtotal);
            console.log(subtotal);
       });
            
        });

      
  </script>
            @endsection
        </html>