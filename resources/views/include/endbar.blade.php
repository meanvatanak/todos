<div class="end-bar">

	<div class="rightbar-title">
		<a href="javascript:void(0);" class="end-bar-toggle float-end">
			<i class="dripicons-cross noti-icon"></i>
		</a>
		<h5 class="m-0">Settings</h5>
	</div>

	<div class="rightbar-content h-100" data-simplebar="">

		<div class="p-3" style="box-sizing: border-box">
			<div class="alert alert-warning" role="alert">
				<strong>Customize </strong> the overall color scheme, sidebar menu, etc.
			</div>
			<hr class="mt-1">

			<!-- Left Sidebar-->
			<h5 class="mt-4">Left Sidebar</h5>
			<hr class="mt-1">
			<div class="form-check form-switch mb-1 ml-3">
				<input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
				<label class="form-check-label" for="default-check">Default</label>
			</div>

			<div class="form-check form-switch mb-1 ml-3">
				<input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
				<label class="form-check-label" for="light-check">Light</label>
			</div>

			<div class="form-check form-switch mb-3 ml-3">
				<input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
				<label class="form-check-label" for="dark-check">Dark</label>
			</div>

			<hr class="mt-1">
			
			<div class="form-check form-switch mb-1 ml-3">
				<input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check" {{ Auth::user()->theme->compact == "fixed" ? "checked" : '' }}>
				<label class="form-check-label" for="fixed-check">Fixed</label>
			</div>

			<div class="form-check form-switch mb-1 ml-3">
				<input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check" {{ Auth::user()->theme->compact == "fixed" ? "checked" : '' }}>
				<label class="form-check-label" for="condensed-check">Condensed</label>
			</div>

			<div class="form-check form-switch mb-1 ml-3">
				<input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check" {{ Auth::user()->theme->compact == "fixed" ? "checked" : '' }}>
				<label class="form-check-label" for="scrollable-check">Scrollable</label>
			</div>

			<div class="d-grid mt-4">
				<button class="btn btn-primary" id="resetBtn">Reset to Default</button>
				<button type="button" id="submit_endbar" class="btn btn-success mt-2" >Save</button>
			</div>
		</div> <!-- end padding-->

	</div>
</div>

<script>
	$(document).ready(function(){
		$('#submit_endbar').on('click', function(e){
			e.preventDefault();
			eThis = $(this);
			theme = $('input[name="theme"]:checked');
			compact = $('input[name="compact"]:checked');
			$.ajax({
				type: 'GET',
				url: '{!! URL::to("theme") !!}',
				data: {'theme': theme.val(), 'compact': compact.val()},
				success:function(data)
				{
					console.log(data);
					if(data == 'done')
					{ $.NotificationApp.send("Theme Setting","Your theme have updated!","top-center","#0FFB00","success"); }
				},
				error:function()
				{

				}
			});
		});
	});
</script>