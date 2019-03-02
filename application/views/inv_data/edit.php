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
      <li class="active"><i class="fa fa-archive"></i> &nbsp; Inventory</li>
      <li class="active">Edit Data</li>
    </ol>
  </section>

  <!-- CONTENT -->
  <section class="content">
	<div class="row">
		<div class="col-lg-12">
		<?php
		if($this->session->flashdata('sukses'))
		{
			echo '<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-success">
							<h4><i class="icon fa fa-check"></i> Sukses!</h4>
							'.$this->session->flashdata('sukses').'
						</div>
					</div>
				</div>';
		}
		if(validation_errors())
		{
			echo '<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-danger">
							<h4><i class="icon fa fa-check"></i> Gagal!</h4>
							'.validation_errors().'
						</div>
					</div>
				</div>';
		}
		?>
		</div>
	</div>
	<!-- ROW -->
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
				<!-- BOX HEADER -->
				<div class="box-header with-border">
					<h3 class="box-title">Edit Inventaris <b><?php echo $detail[0]['jenis_peralatan']; ?></b></h3>
				</div>
				<!-- BOX HEADER -->

				<!-- FORM -->
				<?php echo form_open('inventory/editdata'); ?>
				<div class="box-body">
					<input type="hidden" name="id" value="<?php echo $detail[0]['id']; ?>">
					<div class="form-group">
						<label>Kategori</label>
						<select name="kategori" id="kategori" class="form-control select2">
							<option value="">--- Pilih Kategori ---</option>
							<?php
							foreach($kategori as $kategori)
							{
								echo '<option value="'.$kategori['name'].'"'.set_select('inventaris', $detail[0]['kategori'], ($kategori['name'] == $detail[0]['kategori']) ? TRUE : FALSE).'>'.$kategori['name'].'</option>';
							}
							?>
						</select>
					</div>
					<input type="hidden" name="kode" id="kode">
					<div class="form-group">
						<label>Jenis Peralatan</label>
						<select name="jenisperalatan" class="form-control select2">
							<option value="">--- Pilih Jenis Peralatan ---</option>
							<?php
							foreach($peralatan as $peralatan)
							{
								echo '<option value="'.$peralatan['name'].'"'.set_select('inventaris', $detail[0]['jenis_peralatan'], ($peralatan['name'] == $detail[0]['jenis_peralatan']) ? TRUE : FALSE).'>'.$peralatan['name'].'</option>';
							}
							?>
						</select>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<label>Baik</label>
							<input type="text" class="form-control" name="baik" id="barangbaik" onchange="rubah();" value="<?php echo $detail[0]['baik']; ?>">
						</div>
						<div class="col-lg-6">
							<label>Rusak</label>
							<input type="text" class="form-control" name="rusak" id="barangrusak" onchange="rubah();" value="<?php echo $detail[0]['rusak']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label>Jumlah Barang</label>
						<input type="text" class="form-control" name="jumlah" id="jumlahbarang" value="<?php echo $detail[0]['jumlah']; ?>" readonly>
					</div>
					<br>
					<label>Sumber</label>
					<div class="form-group">
						<label>
							<input type="checkbox" name="apbn" <?php echo set_checkbox('apbn', 'on', ($detail[0]['apbn'] == 'on') ? TRUE : FALSE); ?>>
							APBN
						</label>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" name="apbd_satu" <?php echo set_checkbox('apbd_satu', 'on', ($detail[0]['apbd_satu'] == 'on') ? TRUE : FALSE); ?>>
							APBD I
						</label>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" name="apbd_dua" <?php echo set_checkbox('apbd_dua', 'on', ($detail[0]['apbd_dua'] == 'on') ? TRUE : FALSE); ?>>
							APBD II
						</label>
					</div>
					<div class="form-group">
						<label>
							<input type="checkbox" name="swasta" <?php echo set_checkbox('swasta', 'on', ($detail[0]['swasta'] == 'on') ? TRUE : FALSE); ?>>
							SWASTA
						</label>
					</div>
					<div class="form-group">
							<label>Keterangan</label>
							<input type="text" name="keterangan" class="form-control" value="<?php echo $detail[0]['keterangan']; ?>">
					</div>
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
				<?php echo form_close(); ?>
				<!-- FORM -->
			</div>
		</div>
	</div>
	<!-- ROW -->
</section>
<!-- CONTENT -->
</div>
<!-- /.content-wrapper -->
