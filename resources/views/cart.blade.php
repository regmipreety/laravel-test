@if($cart=Session::get('cart'))
<table id='myTable' class="table">
	<thead>
	<th>Name</th>
	<th>Price</th>
	<th>Quantity</th>
	<th>Subtotal</th>
	<th>Total</th>
</thead>
<tbody>
	<?php $total=0;?>
	@foreach($cart as $id=>$row)
	<tr>
	<td>{{$row['name']}}</td>
	<td>{{$row['price']}}</td>
	<td>{{$row['qty']}}</td>
	<td class="subtotal">{{$row['price']*$row['qty']}}</td>	
	</tr>
	<?php $total=$total+$row['price']*$row['qty'];
	?>


	@endforeach
	<tr><td></td>
		<td></td><td></td><td></td>
		<td>
	<div id="amount">{{$total}}</div>
	</td></tr>
	</tbody>
</table>

@endif