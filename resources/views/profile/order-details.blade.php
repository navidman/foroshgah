@extends('profile.layout')

@section('main')
	<div class="row">
    	<div class="col-12">
        	<div class="card" style="direction: rtl;">
				<div class="card-body table-responsive p-0">
					<table class="table" style="text-align: right;">
				        <tbody>
				            <tr>
				                <th>ایدی محصول</th>
				                <th>عنوان محصول</th>
				                <th>تعداد سفارش</th>
				                <th>هزینه نهایی سفارش</th>
				            </tr>
				            @foreach($order->products as $product)
					        	<tr>
					        		<td>{{ $product->id }}</td>
					        		<td>{{ $product->title }}</td>
					        		<td>{{ $product->pivot->quantity }}</td>
					        		<td>{{ $product->price * $product->pivot->quantity }}</td>
					        	</tr>
				        	@endforeach
				        </tbody>
				    </table>
				</div>
			</div>
		</div>
	</div>

@endsection