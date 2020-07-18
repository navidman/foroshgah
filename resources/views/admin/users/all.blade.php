@component('admin.layouts.content' , ['title' => 'لیست کاربران'])

	@slot('breadcrumb')

		<li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
		<li class="breadcrumb-item active">لیست کاربران</li>

	@endslot

	<h2>Users Panel</h2>
	<div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">جدول کاربران</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
	            <tbody>
		            <tr>
		            	<th>ایدی کاربر</th>
		                <th>نام کاربر</th>
		                <th>نوع کاربر</th>
		                <th>وضعیت ایمیل</th>
		                <th>آدرس ایمیل</th>
		                <th>شماره تلفن</th>
		                <th>اقدامات</th>
		            </tr>
		            @foreach($users as $user)
	            	<tr>
		                <td>{{ $user->id }}</td>
		                <td>{{ $user->name }}</td>
		                @if($user->is_superuser)
		                <td>مدیر</td>
		                @elseif($user->is_staff)
		                <td>کارمند</td>
		                @else
		                <td>کاربر معمولی</td>
		                @endif
		                @if($user->email_verified_at)
		                <td><span class="badge badge-success">فعال</span></td>
		                @else
		                <td><span class="badge badge-danger">غیر فعال</span></td>
		                @endif
		                <td>{{ $user->email }}</td>
		                <td>{{ $user->phone_number }}</td>
		                <td>
		                	<a href="" class="btn btn-sm btn-danger">حذف</a>
		                	<a href="" class="btn btn-sm btn-primary">ویرایش</a>
		                </td>
	            	</tr>
	            	@endforeach
	            </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>

@endcomponent