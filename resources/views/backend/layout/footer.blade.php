
<!-- JAVASCRIPT -->
<script src="{{ asset('backend') }}/assets/libs/jquery/jquery.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/simplebar/simplebar.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/node-waves/waves.min.js"></script>
<!-- Required datatable js -->
<script src="{{ asset('backend') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Responsive examples -->
<script src="{{ asset('backend') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('backend') }}/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('backend') }}/assets/js/pages/dashboard.init.js"></script>
<script>
    var base_url = $('#base_url').val();
    $('.deletenot').click(function() {
        var token = $(this).data('token');
        var id = $(this).attr('notification');
        $.ajax({
            url: base_url + '/read',
            type: 'post',
            data: '_token=' + token + '&notificationID=' + id,
            dataType: 'json',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.alert-danger').fadeIn('fast').delay(1200).fadeOut('slow');
        $('.alert-success').fadeIn('fast').delay(1200).fadeOut('slow');
    });
</script>
@section('backend-footer')
@show
<script src="{{ asset('backend') }}/assets/js/app.js"></script>
