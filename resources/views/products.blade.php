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
          
                    <br><br>


                    <div class="col-md-5">
                        <strong>{{(trans('lang.type'))}}</strong>
                        <input type="text" name="type" class="form-control">
                    </div>

                    <div class="col-md-5">
                        <strong>{{(trans('lang.country'))}}</strong>
                      <br><br>
                        <select class="selectpicker countrypicker" data-live-search="true"data-default="Nepal"data-flag="true" name="country"></select>

                    </div>
                    <div class="col-md-5">
                        <strong>{{(trans('lang.image'))}}</strong>
                        <br><br>
                    Product photos (can attach more than one): <br>
                    <input type="file" name="photos[]" multiple  type="file"> 
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
        @include('ajax_search')

            </div> <!-- list-group / end -->
        
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
  <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";

    if( $('input.typeahead').length ) 
        { 
            $.get(path, function(data){
        $("input.typeahead").typeahead({
            "items": "all",
            "source": data,
            "autoSelect": false,
            displayText: function(item){
                return item.name;
            },
            updater: function(item) {
                window.location.href = '/products/' + item.id+/show/;
            }
        });
    },'json');

      };


$(window).load(function(){


    $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 9000,
    values: [ 75, 300 ],
    slide: function( event, ui ) {
        $( "#amount" ).val( "Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ] );
         var max_price = ui.values[0];
      var min_price = ui.values[1];

   

    }
});
   
});

     
$(document).ready(function(){
    $('#filter').on('click',function(){
        var max=$('#slider-range').slider('values',0);
        var min=$('#slider-range').slider('values',1);
        $.ajax({
            url:"{{route('products.list')}}",
            type:"GET",
            data:{
                max:max,
                min:min
            },
            success:function(data){
               $('#displayProducts').html(data);
            }
        });
    });
});
</script>
 
            @endsection
