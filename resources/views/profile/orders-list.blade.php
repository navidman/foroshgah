@extends('profile.layout')

@section('main')
	<div class="row">
    	<div class="col-12">
        	<div class="card" style="direction: rtl;">
				<div class="card-body table-responsive p-0">
					<table class="table" style="text-align: right;">
				        <tbody>
				            <tr>
				                <th>شماره سفارش</th>
				                <th>تاریخ ثبت</th>
				                <th>وضعیت مرسوله</th>
								<th>کد رهگیری پستی</th>
								<th>اقدامات</th>
				            </tr>
				            @foreach($orders as $order)
					        	<tr>
					        		<td>{{ $order->id }}</td>
					        		<td>{{ jdate($order->created_at)->format('%d %B %Y') }}</td>
					        		<td>{{ $order->status }}</td>
					        		<td>{{ $order->tracking_serial ?? 'هنوز ثبت نشده' }}</td>
					        		<td>
					        			<a href="{{ route('profile.orders.details', $order->id) }}" class="btn btn-sm btn-info">جزيیات سفارش</a>
					        			@if($order->status == 'unpaid')
					        				<a href="{{ route('profile.orders.payment', $order->id) }}" class="btn btn-sm btn-warning">پرداخت مجدد</a>
					        			@endif
					        		</td>
					                
					        	</tr>
				        	@endforeach
				        </tbody>
				    </table>
				    {{ $orders->render() }}
				</div>
			</div>
		</div>
	</div>

@endsection