	<!-- =========================== FOOTER =========================== -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>IT Division</b>
		</div>
		<strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"><?php echo $this->config->item('site_company'); ?></a>.</strong> All rights
		reserved.
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
			<!-- <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li> -->
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<!-- Home tab content -->
			<div class="tab-pane hide" id="control-sidebar-home-tab">
				<h3 class="control-sidebar-heading">Control Sidebar</h3>
				<!-- /.control-sidebar-menu -->
			</div>
			<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
			 immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/bootstrap/js/bootstrap.min.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/plugins/slimScroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/plugins/fastclick/fastclick.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/dist/js/app.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/templates/adminlte-2-3-11/dist/js/demo.js'); ?>"></script>
<script>
$(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
			'copy',
			{
                extend: 'excel',
				messageTop: 'INVENTARIS PERALATAN',
                exportOptions: {
                    columns: ':visible'
                }
            },
			{
                extend: 'pdf',
				messageTop: 'INVENTARIS PERALATAN',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'print',
				messageTop: 'INVENTARIS PERALATAN',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            targets: 0,
            visible: true
        } ]
    } );
	$("#kategori").change(function(){
		if($("#kategori").val() == "Alat Transportasi")
		{
			$("#kode").val("01");
		}
		if($("#kategori").val() == "Alat Komunikasi dan Informasi")
		{
			$("#kode").val("02");
		}
		if($("#kategori").val() == "Alat Pencarian Penyelamatan dan Evakuasi")
		{
			$("#kode").val("03");
		}
		if($("#kategori").val() == "Alat Pemenuhan Kebutuhan Dasar")
		{
			$("#kode").val("04");
		}
		if($("#kategori").val() == "Alat Berat")
		{
			$("#kode").val("05");
		}
		if($("#kategori").val() == "Alat Penerangan dan Kelistrikan")
		{
			$("#kode").val("06");
		}
		if($("#kategori").val() == "Alat Pergudangan")
		{
			$("#kode").val("07");
		}
		if($("#kategori").val() == "Alat Lainnya")
		{
			$("#kode").val("08");
		}
	})
} );
	function rubah()
	{
		var baik = $("#barangbaik").val();
		var rusak = $("#barangrusak").val();
		jumlah = parseInt(baik)+parseInt(rusak);
		$("#jumlahbarang").val(jumlah);
	}
	function hapus()
    {
        job=confirm("Apakah Anda Yakin ingin Menghapus Data Ini?");
        if(job!=true)
        {
            return false;
        }
    }
</script>
</body>
</html>
