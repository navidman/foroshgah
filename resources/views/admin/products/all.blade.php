@component('admin.layouts.content' , ['title' => 'همه ی محصولات'])

	@slot('breadcrumb')

		<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
		<li class="breadcrumb-item active">همه ی دمحصولات</li>

	@endslot
	@slot('script')
		<script>
			$('.js-data-example-ajax').select2({
			  ajax: {
			    url: 'https://api.github.com/search/repositories',
			    dataType: 'json'
			    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
			  }
			});
		</script>
	@endslot

	<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">محصولات</h3>

            <div class="row">
            	<div class="form-group">
	                <select class="js-data-example-ajax" style="width: 400px;"></select>
	             </div>
            </div>

            <div class="card-tools d-flex">
              <form action="">
              	<div class="input-group input-group-sm" style="width: 150px;">
                	<input type="text" name="search" class="form-control float-right" placeholder="جستجو" value="{{ request('search') }}">

	                <div class="input-group-append">
	                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	                </div>
              	</div>
              </form>
              <div class="btn-gruop-sm mr-2">
              	@can('create-product')
              		<a href="{{ route('admin.products.create') }}" class="btn btn-info">ایجاد محصول جدید</a>
       			@endcan
              	
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
	            <tbody>
		            <tr>
		                <th>ایدی محصول</th>
		                <th>عنوان محصول</th>
		                <th>توضیحات</th>
    					<th>قیمت</th>
    					<th>موجودی</th>
    					<th>بازدید</th>
    					<th>اقدامات</th>
		            </tr>
		            @foreach($products as $product)
	            	<tr>
		                <td>{{ $product->id }}</td>
		                <td>{{ $product->title }}</td>
		                <td>{{ $product->description }}</td>
		                <td>{{ $product->price }}</td>
		                <td>{{ $product->inventory }}</td>
		                <td>{{ $product->view_count }}</td>
		                <td class="d-flex">
		                	@can('delete-product')
			                	<form action="{{ route('admin.products.destroy' , $product->id) }}" method="POST">
			                		@csrf
			                		@method('DELETE')
			                		<button type="submit" class="btn btn-sm btn-danger ml-2">حذف</button>
			                	</form>
			                @endcan

		                	@can('edit-product')
		                		<a href="{{ route('admin.products.edit' , $product->id) }}" class="btn btn-sm btn-primary">ویرایش</a>
		                	@endcan
		                	
		                	
		                </td>
	            	</tr>
	            	@endforeach
	            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          	{{ $products->appends(['search' => request('search')])->render() }}
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>

@endcomponent