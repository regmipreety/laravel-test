@extends('layouts.app')
@section('content')

<?php $products = $result['products']; ?>
<div class="container">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Discount</th>
      <th scope="col">Stock</th>
      <th scope="col">Image</th>



    </tr>
  </thead>
  <tbody>
    <tr>
    	
      <th scope="row">1</th>
      <td>{{$products->name}}</td>
      <td>{{$products->price}}</td>
      <td>{{$products->discount}}</td>
      <td>{{$products->stock}}</td>
      <td><img class="img-responsive" alt="" src="/images/{{ $products->image }}" style="height: 100px;width: 100px" /></td>
      	
      
    </tr>
    <th>Reviews</th>
    @foreach($products->review as $item)
      <tr><td>
      
			{{$item->reviews}}
		</td></tr>
		@endforeach
	</tbody>
</table>

	@if ($message = Session::get('success'))
		 <strong>{{ $message }}</strong>
	@endif


<div><br><br>
<button class="btn btn-success" id='btn-reviews'>Add Reviews</button>
<div id="reviews-form"><br><br>
	<form method="post" action='{{route("products.reviews",$products->id)}}'>
		@csrf
		
		<div class="form-group">
    <label for="exampleTextarea">Add Reviews</label>
    <textarea class="form-control" name="reviews" rows="3" cols="50"></textarea>
  </div>
	<button type='submit' class="btn btn-success">Add Reviews</button>
	</form>
</div>
</div>
<script type="text/javascript">
	
$(document).ready(function(){
	$('#reviews-form').hide();
	$('#btn-reviews').on("click",function(){
			$('#reviews-form').show();
	});
	});
	
</script>

@endsection




