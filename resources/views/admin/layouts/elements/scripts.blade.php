<!-- Scripts -->
{{-- <script src="{{ asset('public/AssetsAdmin/bower_components/jquery/dist/jquery.min.js') }}"></script> --}}
<script src="{{ asset('public/AssetsAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/AssetsAdmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/AssetsAdmin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('public/AssetsAdmin/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ asset('public/AssetsAdmin/dist/js/adminlte.min.js') }}"></script>
@stack('footer-scripts')
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
  })
  
	$(window).load(function() {
		$("#pageloader").fadeOut("slow");
	});
</script>
@stack('footer-jquery')
