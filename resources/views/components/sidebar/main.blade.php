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
       
      
     @if(auth()->user()->hasRole('admin'))

      @include('components.sidebar.partials.admin')

    @endrole

    @if(auth()->user()->hasRole('editor') || auth()->user()->hasRole('user'))
      @include('components.sidebar.partials.editor')
    @endrole

      </ul>

    </nav>



    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>
