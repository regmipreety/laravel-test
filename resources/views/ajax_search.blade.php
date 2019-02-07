@if($products->count())
<div class="row">
            <div class="col-md-4 pull-left">
                    Search:<input class="typeahead form-control" type="text" name="search" data-provide="typeahead" autocomplete="off">
            </div>
            <div class="col-md-4 pull-right">
                <div data-role="main" class="ui-content">
                
                 <div data-role="rangeslider" id="slider-range">
                    <br>
                    <input type="text" id="amount" style="border: 0;" />
                    
                 </div>
                 <br>
                <input type="submit" data-inline="true" value="Submit" id="filter">
               
               
                </div>
               
            </div>
           <br><br>
        </div>
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