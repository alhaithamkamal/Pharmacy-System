<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- page script -->
<!-- <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script> -->
<script>

$(".nav-link").click(function () {
          $(this).siblings().removeClass("active");
          $(this).addClass("active");
    });
</script>
<script>
              $(document).ready( function () {
                console.log('hello');
                var table = $('#example1').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('clients.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'gender', name: 'gender'},
                        {data: 'mobile', name: 'mobile'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                
              });
            </script>
