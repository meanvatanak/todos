<div class="leftside-menu">
    
	<!-- LOGO -->
	<a href="{{ url('/dashboard') }}" class="logo text-center logo-light">
		<span class="logo-lg">
			<img src="{{ URL::asset('assets/images/logo-long-white.png') }}" alt="" height="60">
		</span>
		<span class="logo-sm">
			<img src="{{ URL::asset('assets/images/logo-small-white.png') }}" alt="" height="40">
		</span>
	</a>

	<!-- LOGO -->
	<a href="{{ url('/dashboard') }}" class="logo text-center logo-dark">
		<span class="logo-lg">
			<img src="{{ URL::asset('assets/images/logo-long.png') }}" alt="" height="60">
		</span>
		<span class="logo-sm">
			<img src="{{ URL::asset('assets/images/logo-small-white.png') }}" alt="" height="40">
		</span>
	</a>

	<div class="h-100" id="leftside-menu-container" data-simplebar="">

			<!--- Sidemenu -->
		<ul class="side-nav">

			<li class="side-nav-title side-nav-item">Navigation</li>

			<li class="side-nav-item" >
				<a class="side-nav-link" href="{{ url('dashboard')}}">
					<i class="uil-home-alt"></i>
					{{-- <span class="badge bg-success float-end">4</span> --}}
					<span> Dashboards </span>
				</a>
			</li>

			{{--  @if(isset(session('permissions')[9]) && session('permissions')[9]['header'] == 'Permission')
			<li class="side-nav-item">
				<a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
					<i class="uil-store"></i>
					<span> Website </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse" id="sidebarEcommerce">
					<ul class="side-nav-second-level">
						@if(navbarCheck()[2]->name == 'Slideshow')
							<li> <a href="{{ url('slideshow') }}">Slideshow</a> </li>
						@endif
					</ul>
				</div>
			</li>
			@endif  --}}
			@if(isset(session('permissions')[0]) && session('permissions')[0]['header'] == 'Permission')
			<li class="side-nav-item">
				<a data-bs-toggle="collapse" href="#sidebarMaps" aria-expanded="false" aria-controls="sidebarMaps" class="side-nav-link">
					<i class="uil-padlock"></i>
					<span> Permission </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse" id="sidebarMaps">
					<ul class="side-nav-second-level">
						@if(navbarCheck()[0]->name == 'Role')
						<li> <a href="{{ url('role') }}">Role</a> </li>
						@endif
						@if(navbarCheck()[1]->name == 'User')
						<li> <a href="{{ url('user') }}">User</a> </li> 
						@endif
					</ul>
				</div>
			</li>
			@endif

			<li class="side-nav-item" >
				<a class="side-nav-link" href="{{ url('/')}}" target="_blank">
					<i class="mdi mdi-web"></i>
					{{-- <span class="badge bg-success float-end">4</span> --}}
					<span> Website </span>
				</a>
			</li>

			{{-- <li class="side-nav-item">
				<a data-bs-toggle="collapse" href="#sidebarMultiLevel" aria-expanded="false" aria-controls="sidebarMultiLevel" class="side-nav-link">
					<i class="uil-folder-plus"></i>
					<span> Multi Level </span>
					<span class="menu-arrow"></span>
				</a>
				<div class="collapse" id="sidebarMultiLevel">
					<ul class="side-nav-second-level">
						<li class="side-nav-item">
							<a data-bs-toggle="collapse" href="#sidebarSecondLevel" aria-expanded="false" aria-controls="sidebarSecondLevel">
								<span> Second Level </span>
								<span class="menu-arrow"></span>
							</a>
							<div class="collapse" id="sidebarSecondLevel">
								<ul class="side-nav-third-level">
									<li>
										<a href="javascript: void(0);">Item 1</a>
									</li>
									<li>
										<a href="javascript: void(0);">Item 2</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="side-nav-item">
							<a data-bs-toggle="collapse" href="#sidebarThirdLevel" aria-expanded="false" aria-controls="sidebarThirdLevel">
								<span> Third Level </span>
								<span class="menu-arrow"></span>
							</a>
							<div class="collapse" id="sidebarThirdLevel">
								<ul class="side-nav-third-level">
									<li>
										<a href="javascript: void(0);">Item 1</a>
									</li>
									<li class="side-nav-item">
										<a data-bs-toggle="collapse" href="#sidebarFourthLevel" aria-expanded="false" aria-controls="sidebarFourthLevel">
											<span> Item 2 </span>
											<span class="menu-arrow"></span>
										</a>
										<div class="collapse" id="sidebarFourthLevel">
											<ul class="side-nav-forth-level">
												<li>
													<a href="javascript: void(0);">Item 2.1</a>
												</li>
												<li>
													<a href="javascript: void(0);">Item 2.2</a>
												</li>
											</ul>
										</div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</div>
			</li> --}}
		</ul>

		<!-- End Sidebar -->

		<div class="clearfix"></div>

	</div>
	<!-- Sidebar -left -->

</div>