	<!-- =========================== CONTENT =========================== -->

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Inventory
				<small>All your items data</small>
			</h1>
			<ol class="breadcrumb">
				<a href="<?php echo base_url('excel/pdf'); ?>" class="btn btn-danger">EXPORT PDF</a>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<?php
			if($this->session->flashdata('sukses'))
			{
				echo '<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-success alert-dismissible">
								<h4><i class="icon fa fa-check"></i> Sukses!</h4>
								'.$this->session->flashdata('sukses').'
							</div>
						</div>
					</div>';
			}
			?>
			<!-- Default box -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Inventory
					</h3>

					<div class="box-tools pull-right">
						<!-- <button class="btn btn-default btn-box-tool" title="Show / Hide" id="myboxwidget"><i class="fa fa-plus"></i> Show / Hide</button> -->
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
				
					<div class="table-responsive">
						<table id="example1" class="table table-hover table-bordered table-striped">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Kategori</th>
									<th>Jenis Peralatan</th>
									<th>Jumlah</th>
									<th>Kondisi Baik</th>
									<th>Kondisi Rusak</th>
									<th>Sumber Dana APBN</th>
									<th>Sumber Dana APBD I</th>
									<th>Sumber Dana APBD II</th>
									<th>Sumber Dana SWASTA</th>
									<th>Keterangan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($inventaris as $inventaris) { ?>
							<tr>
								<td><?php echo $inventaris['kode']; ?></td>
								<td><?php echo $inventaris['kategori']; ?></td>
								<td><?php echo $inventaris['jenis_peralatan']; ?></td>
								<td><?php echo $inventaris['jumlah']; ?></td>
								<td><?php echo $inventaris['baik']; ?></td>
								<td><?php echo $inventaris['rusak']; ?></td>
								<td><?php echo $inventaris['apbn']; ?></td>
								<td><?php echo $inventaris['apbd_satu']; ?></td>
								<td><?php echo $inventaris['apbd_dua']; ?></td>
								<td><?php echo $inventaris['swasta']; ?></td>
								<td><?php echo $inventaris['keterangan']; ?></td>
								<td width="15%">
									<div class="btn-group-vertical">
										<a class="btn btn-sm btn-default" href="<?php echo base_url('inventory/detail/'.$inventaris['id']) ?>" role="button"><i class="fa fa-eye"></i> Detail</a>
										<a class="btn btn-sm btn-primary" href="<?php echo base_url('inventory/edit/'.$inventaris['id']) ?>" role="button"><i class="fa fa-pencil"></i> Edit</a>
										<input type="hidden" name="id" value="<?php echo $inventaris['id']; ?>">
										<a href="<?php echo base_url('inventory/delete/').$inventaris['id']; ?>" class="btn btn-danger btn-sm" onclick="return hapus();">DELETE</a>
									</div>
								</td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- =========================== / CONTENT =========================== -->
