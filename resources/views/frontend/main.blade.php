<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    @include('front_include.header')

    @yield('style')

</head>

<body>

	<div id="preloader">
		<div class="sk-spinner sk-spinner-wave">
			<div class="sk-rect1"></div>
			<div class="sk-rect2"></div>
			<div class="sk-rect3"></div>
			<div class="sk-rect4"></div>
			<div class="sk-rect5"></div>
		</div>
	</div><!-- End Preload -->

	<div class="layer"></div><!-- Mobile menu overlay mask -->

	<!-- Header================================================== -->

		@include('front_include.top')

		@include('front_include.nav')

	<main>

		@yield('content')

	</main><!-- End main -->

	@include('front_include.footer')


	<i class="mdi mdi-fridge-outline" id="toTop"></i><!-- Back to top button -->

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Terms and conditions</h4>
		  </div>
		  <div class="modal-body">
			<h5>Ei aliquip regione</h5>
			<p>Lorem ipsum dolor sit amet, nibh omnium in eum, ne per omittam eligendi efficiantur. Eos at mundi dolorem, ad cum omnes utroque fastidii, est fastidii apeirian ea. Ne duo diceret partiendo voluptatum, vel at iudico civibus. Purto erant aliquando ex eos, at vel odio modo. In mel tollit reprehendunt, ut usu praesent posidonium cotidieque. Clita assentior maiestatis sea in, at electram voluptaria mel. Tale nusquam adipisci ad mel, partem civibus no vix, sea no accusata dignissim.</p>
			<h5>Altera vocibus eleifend</h5>
			<p>No dico agam error qui, adhuc dicat argumentum sit in. Munere virtute ea ius. Mei an graeco repudiandae disputationi, ex per animal invidunt, probo civibus ne duo. Mea ad officiis temporibus, vim ne idque probatus phaedrum, elit delectus indoctum te has. No sea reprimique necessitatibus, ut usu quas falli.</p>
		  </div>
		</div>
	  </div>
	</div>


    @include('front_include.script')
    @include('sweetalert::alert')
    @yield('script_front')

</body>
<script>
	$(function() {
	// init zeynepjs side menu
	var zeynep = $('.zeynep').zeynep({
	opened: function() {
			// log
			console.log('the side menu opened')
	},
	closed: function() {
			// log
			console.log('the side menu closed')
	}
	})

	// dynamically bind 'closing' event
	zeynep.on('closing', function() {
	// log
	console.log('this event is dynamically binded')
	})

	// handle zeynepjs overlay click
	$('.zeynep-overlay').on('click', function() {
	zeynep.close()
	})

	// open zeynepjs side menu
	$('.btn-open').on('click', function() {
	zeynep.open()
	})
});
</script>
</html>
