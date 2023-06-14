<div class="container-fluid px-3">
	<div class="row">
		<div class="col-lg-2 col-md-2 col-sm-2 col-2">
			{{-- d-xs-block d-lg-block d-md-block d-sm-block d-none --}}
			<div id="logo" class="pb-1">
				<a href="{{ url('/') }}"><img src="{{ url('front-end/img/logo.png') }}" width="190" height="" alt="Home Alarms"></a>
			</div>
		</div>
		<nav class="col-xs-10 col-lg-10 col-md-10 col-ms-10 col-10" style="padding-top: 85px;">
			<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close mt-4" href="javascript:void(0);"><span>Menu mobile</span></a>
			<div class="main-menu">
				{{-- <div id="header_menu">
					<img src="{{ url('front-end/img/logo.png') }}" width="118" height="88" alt="Home Alarms">
				</div> --}}
				<a href="#" class="open_close" id="close_in"><i class="icon_close"></i></a>
				<ul>
					<li><a href="{{ url('/') }}" style="font-size: 17px">Home</a></li>
					<li><a href="{{ url('/services') }}" style="font-size: 17px">Services</a></li>
					<li><a href="{{ url('/portfolio') }}" style="font-size: 17px">Portfolio</a></li>
					<li><a href="{{ url('/assurance-services') }}" style="font-size: 17px">Audit & Assurance Services</a></li>
					<li><a href="{{ url('/documents') }}" style="font-size: 17px">Document And Download</a></li>
					<li><a href="{{ url('/careers') }}" style="font-size: 17px">Career</a></li>
					<li><a href="{{ url('/contact-us') }}" style="font-size: 17px">Contact US</a></li>
					{{-- <li class="submenu">
						<a href="javascript:void(0);" class="show-submenu">Services <i class="icon-down-open-mini"></i></a>
						<ul>
							<li><a href="service_layout_1.html">Service layout 1</a></li>
							<li><a href="services_layout_2.html">Service layout 2</a></li>
							<li><a href="services_layout_3.html">Service layout 3</a></li>
						</ul>
					</li> --}}
				</ul>
			</div><!-- End main-menu -->
		</nav>
	</div>
</div><!-- container -->
