<script>
    toastr.options = {
  "closeButton": true,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "3000",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
</script>

@if(session('success'))
<script>toastr.success("{{ session('success') }}","{{ 'Success' }}")</script>
@endif

@if(session('error'))
<script>toastr.error("{{ session('error') }}","{{ 'Action Failed' }}")</script>
@endif
    