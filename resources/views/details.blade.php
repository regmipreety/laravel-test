@extends('layouts.app')
@section('content')
<div class="container">
  @if ($message = Session::get('success'))
     <strong>{{ $message }}</strong>
  @endif
  
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Discount</th>
      <th scope="col">Stock</th>
      <th scope="col">Type</th>
      <th scope="col">Country</th>
      <th scope="col">Image</th>
</tr>
  </thead>
 <tbody id="sortable">
    <tr>
    	
      <td><a href="#">1</a></td>
      <td>{{$product->name}}</td>
      <td>{{$product->price}}</td>
      <td>{{$product->discount}}</td>
      <td>{{$product->stock}}</td>

      @foreach(json_decode($product->description, true) as $key => $value)
    <td> {{ $value }}</td> 
    @endforeach
      <td><img class="img-responsive" alt="" src="/images/{{ $product->image }}" style="height: 100px;width: 100px" /></td>
  
    </tr>
    
	</tbody>
</table>
<table class="table">
  <thead>Reviews</thead>
  <tbody id="sortable">
    @foreach($product->reviews as $review)
    <tr>
      
      <td>{!!$review->reviews!!}</td>
     
    </tr>
     @endforeach
  </tbody>
  </table>
	


<div><br><br>
<button class="btn btn-success" id='btn-reviews'>Add Reviews</button>
<div id="reviews-form"><br><br>
	<form method="post" action='{{route("products.reviews",$product->id)}}'>
		@csrf
		
		<div class="form-group">
    <label for="exampleTextarea">Add Reviews</label>
    <textarea id="reviews" class="form-control" name="reviews" rows="3" cols="50"></textarea>
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
<script>
  $( function() {
    $( "#sortable" ).sortable({
      items: "tr",
      cursor: 'move',
            opacity: 0.6
    });
    function sendOrderToServer() {

        var order = [];
      $('tr.row1').each(function(index,element) {
                order.push({
                id: $(this).attr('data-id'),
                position: index+1
                });
            });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ url('pages/sorttable') }}",
            data: {
            order:order,
            _token: '{{csrf_token()}}'
            },
        success: function(response) {
            if (response.status == "success") {
              console.log(response);
            } else {
              console.log(response);
            }
        }
      });

    }
});
  </script>
 <script src="{{asset('tinymce/tinymce.min.js')}}"></script>
<script>
  
  tinymce.init({
             selector: "#reviews",
             theme: "modern",
             // width: 680,
             height: 200,
             relative_urls: false,
             remove_script_host: false,
             // document_base_url: BASE_URL,
             plugins: [
                 "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                 "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                 "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
             ],
             toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
             toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
             image_advtab: true,
             external_filemanager_path:"{{asset('filemanager')}}"+"/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "{{asset('filemanager/plugin.min.js')}}"}
         });
</script>
@endsection




