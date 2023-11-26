<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="index.html" class="text-nowrap logo-img">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg" class="dark-logo" width="180" alt="" />
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg" class="light-logo"  width="180" alt="" />
      </a>
      <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8 text-muted"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar>
      <ul id="sidebarnav">
        <!-- ============================= -->
        <!-- Home -->
        <!-- ============================= -->
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">  </span>
        </li>
    
        <li class="sidebar-item">
          <a class="sidebar-link justify-content-between" href="{{ route('home')}}" aria-expanded="false">
            <div class="d-flex align-items-center gap-3">
              <span class="d-flex">
                <i class="ti ti-dashboard"></i>
              </span>
              <span class="hide-menu">Dashboard</span>
            </div>
          </a>
        </li>
       

        <li class="sidebar-item">
          <a class="sidebar-link" href="{{ route('business-profiles.index') }}" aria-expanded="false">
            <span class="d-flex">
              <i class="ti ti-user"></i>
            </span>
            <span class="hide-menu">Business Profile</span>
          </a>
        </li> 


      </ul>

    </nav>



    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
