<div id="alert-messsge">
	@if (session()->has('success'))
		<div class="box-top">
			<div class="al-success">
				<strong>{{ session('success') }}</strong>
			</div>
		</div>
	@endif
	@if (session()->has('error'))
		<div class="box-top">
			<div class="al-error">
				<strong>{{ session('error') }}</strong>
			</div>
		</div>
	@endif
</div>
<script src="{!! asset('admin/js/script.js') !!}"></script>
