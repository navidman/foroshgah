@component('admin.layouts.content' , ['title' => 'ایجاد دسته جدید'])

	@slot('breadcrumb')

		<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
		<li class="breadcrumb-item"><a href="/admin/categories">لیست دسته بندی ها</a></li>
		<li class="breadcrumb-item active">ایجاد دسته جدید</li>
	    
	@endslot

	<div class="row">
		<div class="col-lg-12">
			@include('admin.layouts.error')
			<div class="card">
        <div class="card-header">
          <h3 class="card-title">فرم ایجاد دسته جدید</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">نام دسته</label>

                <input type="text" name="name" class="form-control" id="name" placeholder="نام دسته را وارد کنید" value="{{ old('name') }}">
              
            </div>
            @if(request('parent'))
                @php
                    $parent = \App\Category::find(request('parent'))
                @endphp
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">نام دسته</label>
                    <input type="text" class="form-control" id="inputEmail3" disabled value="{{ $parent->name }}">
                    <input type="hidden" name="parent" value="{{ $parent->id }}">
                </div>
            @endif
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-info">ثبت</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-default float-left">لغو</a>
          </div>
            
          <!-- /.card-footer -->
        </form>
      </div>
		</div>
	</div>


@endcomponent