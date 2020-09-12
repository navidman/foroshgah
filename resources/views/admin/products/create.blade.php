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

      let changeAttributeValues = (event , id) => {
        let valueBox = $(`select[name='attributes[${id}][value]']`);
        console.log(event.target.value);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : document.head.querySelector('meta[name="csrf-token"]').content,
                'Content-Type' : 'application/json'
            }
        })

        $.ajax({
          type : 'POST',
          url : '/admin/attribute/values',
          data : JSON.stringify({
              name : event.target.value
          }),
          success : function(data) {
            console.log(data);
              valueBox.html(`
                  <option value="" selected>انتخاب کنید</option>
                  ${
                  data.data.map(function (item) {
                      return `<option value="${item}">${item}</option>`
                  })
              }
              `);

              $('.attribute-select').select2({ tags : true });
          }
      });
    }

    let createNewAttr = ({ attributes , id }) => {
        return `
            <div class="row" id="attribute-${id}">
                <div class="col-5">
                    <div class="form-group">
                         <label>عنوان ویژگی</label>
                         <select name="attributes[${id}][name]" onchange="changeAttributeValues(event, ${id});" class="attribute-select form-control">
                            <option value="">انتخاب کنید</option>
                            ${
                                attributes.map(function(item) {
                                    return `<option value="${item}">${item}</option>`
                                })
                            }
                         </select>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-group">
                         <label>مقدار ویژگی</label>
                         <select name="attributes[${id}][value]" class="attribute-select form-control">
                                <option value="">انتخاب کنید</option>
                         </select>
                    </div>
                </div>
                 <div class="col-2">
                    <label >اقدامات</label>
                    <div>
                        <button type="button" class="btn btn-sm btn-warning" onclick="document.getElementById('attribute-${id}').remove()">حذف</button>
                    </div>
                </div>
            </div>
        `
    }

    $('#add_product_attribute').click(function() {
        let attributesSection = $('#attribute_section');
        let id = attributesSection.children().length;
        let attributes = $('#attributes').data('attributes');

        attributesSection.append(
            createNewAttr({
                attributes,
                id
            })
        );

        $('.attribute-select').select2({ tags : true });
    });

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
              <div id="attributes" data-attributes="{{ json_encode(\App\Attribute::all()->pluck('name')) }}"></div>
              <form class="form-horizontal" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label for="image" class="col-sm-2 control-label">آپلود تصویر شاخص</label>

                   
                      <input type="file" name="image" class="form-control">
                    
                  </div>

                  <div class="form-group">
                    <label for="label" class="col-sm-2 control-label">دسته بندی ها</label>

                   
                    <select class="form-control" name="categories[]" id="categories" multiple="">
                      @foreach(\App\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                    
                  </div>
                  <h6>ویژگی محصول</h6>
                  <hr>
                  <div id="attribute_section"></div>
                  <button class="btn btn-sm btn-danger" type="button" id="add_product_attribute">ویژگی جدید</button>
                  
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