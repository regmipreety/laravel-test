@extends('layouts.app')
@section('content')

<body>
    <div class="container">

     @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>

        @endif
        @if(Auth::check())
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
                        <!-- <input type="file" name="image" class="form-control"> 
                        -->
                        <br><br>
                    Product photos (can attach more than one): <br>
                    <input type="file" name="photos[]" multiple  type="file"> 
                    <br><br>
                    </div>
                    <div class="col-md-2">
                        <br/>
                        <button type="submit" class="btn btn-success">{{(trans('lang.upload'))}}</button>
                    </div>
                </div>
            </form>
        </div>
        @endif
            <span>Total:
                <div id="sumTotal"></div>
        </span>
   
        <div id="displayProducts">
        @if($products->count())
        <div class="row">
                
                    @foreach($products as $image)
            <div class="col-md-4 col-lg-4 col-xs-12">
            <div class="panel panel-default">
                    @if(Auth::check())
                    <form action="{{ route('products.delete',$image->id) }}" method="GET">
                        <button type="submit" class="close-icon btn btn-danger pull-right"><i class="glyphicon glyphicon-remove"></i></button>


                    </form>
                    <form action='{{route("products.edit",$image->id)}}' method="get">
                        <button type="submit" class="close-icon btn btn-danger pull-left"><i class="glyphicon glyphicon-pencil"></i></button>
                    </form>
                    @endif
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
                                            <input type="number" name="amount" placeholder="quanity" class="qty" data-price="{{$image->price}}" >
                                        </div>
                                        <div class="form-group col-xs-6 total"><label>Total:</label></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary price submitprice" data-price="{{$image->price}}" data-id="{{$image->id}}" data-name="{{$image->name}}" >Save changes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            </div>
            </div>
                    @endforeach
                    
                <div id="productslist">
                    @include('cart')
                </div>

            @endif

            </div> <!-- list-group / end -->
        </div>
            </div> <!-- row / end -->
 <script type="text/javascript">
     $(document).ready(function(){
            $('#inputform').hide();
         $('#btn-create').click(function(){
            $('#inputform').show();
            $('#displayProducts').hide();
        });
         var subtotal=0;
         var qty=0;
       $('.qty').on('change',function(){
         qty=$(this).val();
            
       });
          
          $(".submitprice").on('click',function(){
            var id=$(this).data('id');
            var price=$(this).data('price');
            var name=$(this).data('name');
            $.ajax({
                type:"get",
                url:"/products/addTocart/"+id,
                data:{
                    id:id,
                    price:price,
                    qty:qty,
                    name:name
                },
                success:function(data){
                    $("#productslist").html(data);
                }
               
            });
          });
           
        });

      
  </script>
 
            @endsection
