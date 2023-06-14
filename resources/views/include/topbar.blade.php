<div class="navbar-custom">
  <ul class="list-unstyled topbar-menu float-end mb-0">

    <li class="notification-list">
			<a class="nav-link end-bar-toggle" href="javascript: void(0);">
				<i class="dripicons-gear noti-icon"></i>
			</a>
    </li>
      
		<li class="dropdown notification-list">
			<a class="nav-link  nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
				<span class="account-user-avatar p-0"> 
					<img src="{{ Auth::user()->image ? url('img/user/'.Auth::user()->image) : url('img/icon/default-user-image.png') }}" alt="user-image" class="rounded-circle">
				</span>
				<span>
					<span class="account-user-name p-0">{{ Auth::user()->name }}</span>
					<span class="account-position p-0">{{ Auth::user()->role->role_name }}</span>
				</span>
			</a>
			<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
				<!-- item-->
				{{-- <div class=" dropdown-header noti-title">
						<h6 class="text-overflow m-0">Welcome !</h6>
				</div> --}}

				<!-- item-->
				<a href="{!! url('userinfo/' . base64_encode(Auth::user()->id) . '/edit') !!}" class="dropdown-item notify-item">
					<i class="mdi mdi-account-circle me-1"></i>
					<span>My Account</span>
				</a>

				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#bs-example-modal-sm">
					<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
					Logout
				</a>
						
			</div>
		</li>

  </ul>
  <button class="button-menu-mobile open-left">
      <i class="mdi mdi-menu"></i>
  </button>
 
</div>

<!-- Logout Modal-->
<div class="modal fade" id="bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="mySmallModalLabel">Ready to Leave?</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				Select "Logout" below if you are ready to end your current session.
			</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
			</div>
		</div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->