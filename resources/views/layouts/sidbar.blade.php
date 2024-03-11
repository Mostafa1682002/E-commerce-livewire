  <!--sidebar wrapper -->
  <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
          <div>
              <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
          </div>
          <div>
              <h4 class="logo-text">Rocker</h4>
          </div>
          <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
          </div>
      </div>
      <!--navigation-->
      <ul class="metismenu" id="menu">
          <li>
              <a href="{{ route('admin.home') }}">
                  <div class="parent-icon"><i class='bx bx-home-circle'></i>
                  </div>
                  <div class="menu-title">Home</div>
              </a>
          </li>
          @can('categories-list')
              <li>
                  <a href="{{ route('admin.categories.index') }}">
                      <div class="parent-icon"><i class='bx bx-category'></i>
                      </div>
                      <div class="menu-title">Categories</div>
                  </a>
              </li>
          @endcan
          @can('products-list')
              <li>
                  <a href="javascript:;" class="has-arrow">
                      <div class="parent-icon"><i class='bx bx-store-alt'></i>
                      </div>
                      <div class="menu-title">Products</div>
                  </a>
                  <ul>
                      <li> <a href="{{ route('admin.products.index') }}"><i class="bx bx-right-arrow-alt"></i>Products</a>
                      </li>
                      @can('products-create')
                          <li> <a href="{{ route('admin.products.create') }}"><i class="bx bx-right-arrow-alt"></i>Add
                                  Product</a>
                          </li>
                      @endcan
                  </ul>
              </li>
          @endcan
          @can('orders-list')
              <li>
                  <a href="{{ route('admin.orders.index') }}">
                      <div class="parent-icon"><i class="bx bx-cart"></i>
                      </div>
                      <div class="menu-title">Orders</div>
                  </a>
              </li>
          @endcan
          @can('users-list')
              <li>
                  <a href="{{ route('admin.users.index') }}">
                      <div class="parent-icon"><i class="bx bx-user"></i>
                      </div>
                      <div class="menu-title">Users</div>
                  </a>
              </li>
          @endcan
          @can('coupones-list')
              <li>
                  <a href="{{ route('admin.coupones.index') }}">
                      <div class="parent-icon"><i class="bx bx-gift"></i>
                      </div>
                      <div class="menu-title">Coupones</div>
                  </a>
              </li>
          @endcan
          @can('slider-list')
              <li>
                  <a href="{{ route('admin.slider.index') }}">
                      <div class="parent-icon"><i class="bx bx-repeat"></i>
                      </div>
                      <div class="menu-title">Home Slider</div>
                  </a>
              </li>
          @endcan
          @can('admins-list')
              <li>
                  <a href="{{ route('admin.admins.index') }}">
                      <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i>
                      </div>
                      <div class="menu-title">Admins</div>
                  </a>
              </li>
          @endcan
          @can('roles-list')
              <li>
                  <a href="{{ route('admin.roles.index') }}">
                      <div class="parent-icon"><i class="fadeIn animated bx bx-detail"></i>
                      </div>
                      <div class="menu-title">Roles</div>
                  </a>
              </li>
          @endcan
          @can('setting-show')
              <li>
                  <a href="{{ route('admin.setting') }}">
                      <div class="parent-icon"><i class='bx bx-cog'></i>
                      </div>
                      <div class="menu-title">Settings</div>
                  </a>
              </li>
          @endcan
      </ul>
      <!--end navigation-->
  </div>
  <!--end sidebar wrapper -->
