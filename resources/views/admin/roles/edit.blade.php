@component('admin.layouts.content' , ['title' => 'ویرایش نقش ها'])

  @slot('breadcrumb')

    <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
    <li class="breadcrumb-item"><a href="/admin/roles">همه ی نقش ها</a></li>
    <li class="breadcrumb-item active">ویرایش نقش ها</li>
      
  @endslot

  @slot('script')
    <script>
      $('#roles').select2({
        'placeholder' : 'نقش های مورد نظر را انتخاب کنید'
      })
      $('#permissions').select2({})
    </script>

  @endslot

  <div class="row">
    <div class="col-lg-12">
      @include('admin.layouts.error')
      <div class="card">
              <div class="card-header">
                <h3 class="card-title">فرم ویرایش نقش ها</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="{{ route('admin.roles.update' , $role->id) }}" method="POST">
              @csrf
              @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">عنوان نقش</label>

                   
                      <input type="text" name="name" class="form-control" id="name" placeholder="عنوان را وارد کنید" value="{{ old('name' , $role->name) }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="label" class="col-sm-2 control-label">توضیحات نقش</label>

                   
                      <input type="text" name="label" class="form-control" id="label" placeholder="توضیحات را وارد کنید" value="{{ old('label' , $role->label) }}">
                    
                  </div>
                  <div class="form-group">
                    <label for="label" class="col-sm-2 control-label">دسترسی ها</label>

                   
                    <select class="form-control" name="permissions[]" id="permissions" multiple="">
                      @foreach(\App\Permission::all() as $permission)
                        <option value="{{ $permission->id }}" {{ in_array($permission->id , $role->permissions->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $permission->name }} - {{ $permission->label }}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">ویرایش</button>
                  <a href="{{ route('admin.roles.index') }}" class="btn btn-default float-left">لغو</a>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
    </div>
  </div>


@endcomponent