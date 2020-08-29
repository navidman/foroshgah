@component('admin.layouts.content' , ['title' => 'ایجاد محصول جدید'])

	@slot('breadcrumb')

		<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
		<li class="breadcrumb-item"><a href="/admin/products">همه محصولات</a></li>
		<li class="breadcrumb-item active">ایجاد محصول جدید</li>
	    
	@endslot
   @slot('script')
    <script>
      $('#categories').select2({
        'placeholder' : 'دسته های مورد نظر را انتخاب کنید'
      })
    </script>

  @endslot

	<div class="row">
		<div class="col-lg-12">
			@include('admin.layouts.error')
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">فرم ایجاد محصول جدید</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('admin.products.store') }}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">عنوان محصول</label>

                   
                      <input type="text" name="title" class="form-control" id="title" placeholder="عنوان را وارد کنید" value="{{ old('title') }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">توضیحات توضیحات</label>
                      <textarea name="description" class="form-control" id="description" placeholder="توضیحات را وارد کنید" cols="30" rows="10" value="{{ old('description') }}"></textarea>
                      
                    
                  </div>
                  <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">قیمت</label>

                   
                      <input type="number" name="price" class="form-control" id="price" placeholder="قیمت را وارد کنید" value="{{ old('price') }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="inventory" class="col-sm-2 control-label">موجودی</label>

                   
                      <input type="number" name="inventory" class="form-control" id="inventory" placeholder="موجودی را وارد کنید" value="{{ old('inventory') }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="label" class="col-sm-2 control-label">دسته بندی ها</label>

                   
                    <select class="form-control" name="categories[]" id="categories" multiple="">
                      @foreach(\App\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ثبت</button>
                  <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
		</div>
	</div>


@endcomponent