<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start custom-sidebar" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header custom-sidebar-header">
    <h5 class="offcanvas-title lavender-header" id="sidebarMenuLabel">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body custom-sidebar-body">
    <ul class="nav flex-column">
      <li class="nav-item mb-2">
       <a class="nav-link sidebar-link d-flex align-items-center" href="{{ route('dashboard') }}">
    <i class="fa fa-home me-2"></i>
    Dashboard
</a>
      </li>
      <li class="nav-item mb-2">
        <a class="nav-link sidebar-link d-flex align-items-center" href="{{ url('/tasks') }}">
          <i class="fa fa-tasks me-2"></i>
          Task
        </a>
      </li>
    </ul>
  </div>
</div>

@push('styles')
<style>

</style>
@endpush
