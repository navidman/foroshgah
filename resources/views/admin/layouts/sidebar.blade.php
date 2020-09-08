<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/admin" class="brand-link">
    <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">پنل مدیریت</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" style="direction: ltr">
    <div style="direction: rtl">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="img/navidman1.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">نوید منصوری</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin" class="nav-link {{ isActive('admin.') }}">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>پنل مدیریت</p>
            </a>
          </li>
          @can('show-users')
            <li class="nav-item has-treeview {{ isActive(['admin.users.index' , 'admin.users.edit' , 'admin.users.create'] , 'menu-open') }}">
              <a href="#" class="nav-link {{ isActive(['admin.users.index' , 'admin.users.edit' , 'admin.users.create']) }}">
                <i class="fa fa-user nav-icon"></i>
                <p>
                  کاربران
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="{{ route('admin.users.index') }}" class="nav-link {{ isActive('admin.users.index') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست کاربران</p>
                  </a>
                </li>
              </ul>
            </li>
          @endcan
          @canany(['show-roles' , 'show-permissions'])
            <li class="nav-item has-treeview {{ isActive(['admin.permissions.index' , 'admin.permissions.edit' , 'admin.permissions.create' , 'admin.roles.index' , 'admin.roles.edit' , 'admin.roles.create'] , 'menu-open') }}">
              <a href="#" class="nav-link {{ isActive(['admin.permissions.index' , 'admin.permissions.edit' , 'admin.permissions.create' , 'admin.roles.index' , 'admin.roles.edit' , 'admin.roles.create']) }}">
                <i class="fa fa-user nav-icon"></i>
                <p>
                  دسترسی ها
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              @can('show-roles')
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview">
                    <a href="{{ route('admin.roles.index') }}" class="nav-link {{ isActive('admin.roles.index') }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>همه ی نقش ها</p>
                    </a>
                  </li>
                </ul>
              @endcan

              @can('show-permissions')
                <ul class="nav nav-treeview">
                  <li class="nav-item has-treeview">
                    <a href="{{ route('admin.permissions.index') }}" class="nav-link {{ isActive('admin.permissions.index') }}">
                      <i class="fa fa-users nav-icon"></i>
                      <p>همه ی دسترسی ها</p>
                    </a>
                  </li>
                </ul>
              @endcan
            </li>
          @endcanany
          @can('show-products')
            <li class="nav-item has-treeview {{ isActive(['admin.products.index' , 'admin.products.edit' , 'admin.products.create'] , 'menu-open') }}">
              <a href="#" class="nav-link {{ isActive(['admin.products.index' , 'admin.products.edit' , 'admin.products.create']) }}">
                <i class="fa fa-user nav-icon"></i>
                <p>
                  محصولات
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="{{ route('admin.products.index') }}" class="nav-link {{ isActive('admin.products.index') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست محصولات</p>
                  </a>
                </li>
              </ul>
            </li>
          @endcan
          @can('show-comments')
            <li class="nav-item has-treeview {{ isActive(['admin.comments.index' , 'admin.comments.edit'] , 'menu-open') }}">
              <a href="#" class="nav-link {{ isActive(['admin.comments.index' , 'admin.comments.edit']) }}">
                <i class="fa fa-user nav-icon"></i>
                <p>
                  نظرات
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="{{ route('admin.comments.index') }}" class="nav-link {{ isActive('admin.comments.index') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست نظرات تایید شده</p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="{{ url('admin/comments/unapproved') }}" class="nav-link {{ isActive('admin.comments.unapproved') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست نظرات تایید نشده</p>
                  </a>
                </li>
              </ul>
            </li>
          @endcan
          @can('show-categories')
            <li class="nav-item has-treeview {{ isActive(['admin.categories.index' , 'admin.categories.edit'] , 'menu-open') }}">
              <a href="#" class="nav-link {{ isActive(['admin.categories.index' , 'admin.categories.edit']) }}">
                <i class="fa fa-user nav-icon"></i>
                <p>
                  دسته بندی ها
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="{{ route('admin.categories.index') }}" class="nav-link {{ isActive('admin.comments.index') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست دسته بندی ها</p>
                  </a>
                </li>
                <!-- <li class="nav-item has-treeview">
                  <a href="{{ url('admin/comments/unapproved') }}" class="nav-link {{ isActive('admin.comments.unapproved') }}">
                    <i class="fa fa-users nav-icon"></i>
                    <p>لیست نظرات تایید نشده</p>
                  </a>
                </li> -->
              </ul>
            </li>
          @endcan
          @can('show-categories')
            <li class="nav-item has-treeview {{ isActive(['admin.orders.index',] , 'menu-open') }}">
                <a href="#" class="nav-link {{ isActive(['admin.orders.index']) }}">
                    <i class="nav-icon fa fa-users"></i>
                    <p>
                        بخش سفارشات
                        <i class="right fa fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index' , ['type' => 'unpaid']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'unpaid'])) }}">
                            <i class="fa fa-circle-o nav-icon text-warning"></i>
                            <p>پرداخت نشده
                                <span class="badge badge-warning right">{{ \App\Order::whereStatus('unpaid')->count() }}</span>
                            </p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index' , ['type' => 'paid']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'paid'])) }}">
                            <i class="fa fa-circle-o nav-icon text-info"></i>
                            <p>پرداخت شده
                                <span class="badge badge-info right">{{ \App\Order::whereStatus('paid')->count() }}</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index'  , ['type' => 'preparation']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'preparation'])) }}">
                            <i class="fa fa-circle-o nav-icon text-primary"></i>
                            <p>در حال پردازش
                                <span class="badge badge-primary right">{{ \App\Order::whereStatus('preparation')->count() }}</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index' , ['type' => 'posted']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'posted'])) }}">
                            <i class="fa fa-circle-o nav-icon text text-light"></i>
                            <p>ارسال شده
                                <span class="badge badge-light right">{{ \App\Order::whereStatus('posted')->count() }}</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index' , ['type' => 'received']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'received'])) }}">
                            <i class="fa fa-circle-o nav-icon text-success"></i>
                            <p>دریافت شده
                                <span class="badge badge-success right">{{ \App\Order::whereStatus('received')->count() }}</span>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index' , ['type' => 'canceled']) }}" class="nav-link {{ isUrl(route('admin.orders.index' , ['type' => 'canceled'])) }}">
                            <i class="fa fa-circle-o nav-icon text-danger"></i>
                            <p>کنسل شده
                                <span class="badge badge-danger right">{{ \App\Order::whereStatus('canceled')->count() }}</span>
                            </p>
                        </a>
                    </li>
                </ul>
            </li>
          @endcan
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </div>
  <!-- /.sidebar -->
</aside>