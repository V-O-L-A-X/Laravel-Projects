<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="{{route('admin.dashboard')}}">
       <img src="adminstyle/assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
       <h5 class="logo-text">Dashtreme Admin</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
      <li class="sidebar-header">MAIN NAVIGATION</li>
      <li>
        <a href="{{route('admin.dashboard')}}">
          <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>

      <li>
        <a href="{{route('category.index')}}">
          <i class="zmdi zmdi-invert-colors"></i> <span>Category</span>
        </a>
      </li>

      <li>
        <a href="{{route('subcat.index')}}">
          <i class="zmdi zmdi-format-list-bulleted"></i> <span>Sub Category</span>
        </a>
      </li>

      <li>
        <a href="{{route('brand.index')}}">
          <i class="zmdi zmdi-grid"></i> <span>Brand</span>
          <small class="badge float-right badge-light">New</small>
        </a>
      </li>

      <li>
        <a href="{{route('product.index')}}">
          <i class="zmdi zmdi-calendar-check"></i> <span>Product</span>
          
        </a>
      </li>

      <li>
        <a href="{{route('shipping.create')}}">
          <i class="zmdi zmdi-face"></i> <span>Shipping</span>
        </a>
      </li>

      <li>
        <a href="{{route('coupons.index')}}">
          <i class="zmdi zmdi-lock"></i> <span>Discount</span>
        </a>
      </li>

       <li>
        <a href="{{route('order.index')}}">
          <i class="zmdi zmdi-account-circle"></i> <span>Orders</span>
        </a>
      </li>

      <li>
        <a href="{{route('user.index')}}">
          <i class="zmdi zmdi-coffee"></i> <span>Users</span>
        </a>
      </li>
      <li>
        <a href="{{route('page.index')}}">
          <i class="zmdi zmdi-chart-donut"></i> <span>Pages</span>
        </a>
      </li>

      <li>
        <a href="{{route('product.productRating')}}">
          <i class="zmdi zmdi-share"></i> <span>Ratings</span>
        </a>
      </li>

      

    </ul>
   
   </div>