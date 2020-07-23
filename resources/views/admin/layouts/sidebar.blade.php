<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
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
            <a href="{{ route('admin.') }}" class="nav-link {{ isActive('admin.') }}">
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
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </div>
  <!-- /.sidebar -->
</aside>