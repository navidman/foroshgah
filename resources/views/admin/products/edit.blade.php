@component('admin.layouts.content' , ['title' => 'ویرایش محصولات'])

  @slot('breadcrumb')

    <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
    <li class="breadcrumb-item"><a href="/admin/products">همه ی محصولات</a></li>
    <li class="breadcrumb-item active">ویرایش محصولات</li>
      
  @endslot

  <div class="row">
    <div class="col-lg-12">
      @include('admin.layouts.error')
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">فرم ویرایش محصولات</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('admin.products.update' , $product->id) }}" method="POST">
              @csrf
              @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label for="title" class="col-sm-2 control-label">عنوان محصول</label>

                   
                      <input type="text" name="title" class="form-control" id="title" placeholder="عنوان را وارد کنید" value="{{ old('title' , $product->title) }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="description" class="col-sm-2 control-label">توضیحات توضیحات</label>

                   
                      <input type="text" name="description" class="form-control" id="description" placeholder="توضیحات را وارد کنید" value="{{ old('description' , $product->description) }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="price" class="col-sm-2 control-label">قیمت</label>

                   
                      <input type="text" name="price" class="form-control" id="price" placeholder="قیمت را وارد کنید" value="{{ old('price' , $product->price) }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="inventory" class="col-sm-2 control-label">موجودی</label>

                   
                      <input type="text" name="inventory" class="form-control" id="inventory" placeholder="موجودی را وارد کنید" value="{{ old('inventory' , $product->inventory) }}">
                    
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ویرایش</button>
                  <a href="{{ route('admin.products.index') }}" class="btn btn-default float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
    </div>
  </div>


@endcomponent