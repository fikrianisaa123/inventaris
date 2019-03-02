<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $this->config->item('site_name'); ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/templates/adminlte-2-3-11/bootstrap/css/bootstrap.min.css'); ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/templates/adminlte-2-3-11/dist/css/AdminLTE.min.css'); ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url('assets/templates/adminlte-2-3-11/dist/css/skins/_all-skins.min.css'); ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url(); ?>" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b><?php echo strtoupper(substr($this->config->item('site_name'), 0, 1)); ?></b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><?php echo $this->config->item('site_name'); ?></span>
		</a>
	</header>
  
  <aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- search form -->
			<form action="<?php echo base_url('inventory/search') ?>" method="post" class="sidebar-form" autocomplete="off">
				<div class="input-group">
					<input type="text" name="keyword" class="form-control" placeholder="ketik untuk mencari..">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu">
				<li class="header">	NAVIGASI UTAMA</li>
				<li>
					<a href="<?php echo base_url() ?>">
						<i class="fa fa-home"></i> <span>Beranda</span>
					</a>
				</li>

			<?php if ($this->ion_auth->logged_in()): ?>
				<li class="treeview">
          <a href="#"><i class="fa fa-archive"></i> <span>Inventory</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('inventory') ?>"><i class="fa fa-plus"></i> Tambah Baru</a></li>
            <li><a href="<?php echo base_url('inventory/all') ?>"><i class="fa fa-list-alt"></i> Semua Data</a></li>
            <li><a href="<?php echo base_url('inventory/by_category') ?>"><i class="fa fa-star-o"></i> Per-Kategori</a></li>
            <li><a href="<?php echo base_url('inventory/by_location') ?>"><i class="fa fa-map-pin"></i> Per-Lokasi</a></li>
            <li><a href="<?php echo base_url('inventory/search') ?>"><i class="fa fa-search"></i> Cari</a></li>
          </ul>
        </li>
				<?php if ($this->ion_auth->is_admin()): ?>
					<li class="header">MASTER</li>
					<li>
						<a href="<?php echo base_url('categories') ?>">
							<i class="fa fa-star"></i> <span>Kategori</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('locations') ?>">
							<i class="fa fa-map-marker"></i> <span>Lokasi</span>
						</a>
					</li>
				
					<li>
						<a href="<?php echo base_url('color') ?>">
							<i class="fa fa-tint"></i> <span>Peralatan</span>
						</a>
					</li>
				
					<li>
						<a href="<?php echo base_url('status') ?>">
							<i class="fa fa-heart"></i> <span>Status</span>
						</a>
					</li>
					
					<!-- Menu Admin -->
					<li class="header">PENGATURAN</li>
					<li>
						<a href="<?php echo base_url('auth') ?>">
							<i class="fa fa-users"></i> <span>Users</span>
						</a>
					</li>
				<?php endif ?>
				<li class="header">PILIHAN</li>
				<li>
					<a href="<?php echo base_url('auth/logout') ?>">
						<i class="fa fa-sign-out"></i> <span>Keluar</span>
					</a>
				</li>
			<?php else: ?>
				<li>
					<a href="<?php echo base_url('auth/login') ?>">
						<i class="fa fa-sign-in"></i> <span>Login</span>
					</a>
				</li>
			<?php endif ?>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Alat Transportasi</h3>
                    </div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                            </tr>
                            <tbody>
                                <?php foreach($data as $row) { ?>
                                <tr>
                                    <td><?php echo $row['code']; ?></td>
                                    <td><?php echo $row['color']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
            targets: -1,
            visible: false
        } ]
    } );
} );
</script>
</body>
</html>
