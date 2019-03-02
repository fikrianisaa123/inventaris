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
				<li class="active">Tambah Baru</li>
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
					echo validation_errors();
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
							<h3 class="box-title">Tambah Inventaris</h3>
						</div>
						<!-- BOX HEADER -->

						<!-- FORM -->
						<?php echo form_open_multipart('inventory/tambahdata'); ?>
						<div class="box-body">
							<div class="form-group">
								<label>Upload Foto</label>
								<input type="file" name="gambar" id="gambar" class="form-control">
							</div>
							<div class="form-group">
								<label>Kategori</label>
								<select name="kategori" id="kategori" class="form-control select2">
									<option value="">--- Pilih Kategori ---</option>
									<option value="Alat Transportasi">Alat Transportasi</option>
									<option value="Alat Komunikasi dan Informasi">Alat Komunikasi dan Informasi</option>
									<option value="Alat Pencarian Penyelamatan dan Evakuasi">Alat Pencarian Penyelamatan dan Evakuasi</option>
									<option value="Alat Pemenuhan Kebutuhan Dasar">Alat Pemenuhan Kebutuhan Dasar</option>
									<option value="Alat Berat">Alat Berat</option>
									<option value="Alat Penerangan dan Kelistrikan">Alat Penerangan dan Kelistrikan</option>
									<option value="Alat Pergudangan">Alat Pergudangan</option>
									<option value="Alat Lainnya">Alat Lainnya</option>
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
										echo '<option value="'.$peralatan['name'].'">'.$peralatan['name'].'</option>';	
									}
									?>
								</select>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<label>Baik</label>
									<input type="text" class="form-control" name="baik" id="barangbaik" onchange="rubah();" placeholder="Jumlah Baik">
								</div>
								<div class="col-lg-6">
									<label>Rusak</label>
									<input type="text" class="form-control" name="rusak" id="barangrusak" onchange="rubah();" placeholder="Jumlah Rusak">
								</div>
							</div>
							<div class="form-group">
								<label>Jumlah Barang</label>
								<input type="text" class="form-control" name="jumlah" id="jumlahbarang" value="0" readonly>
							</div>
							<br>
							<label>Sumber</label>
							<div class="form-group">
								<label>
									<input type="checkbox" name="apbn">
									APBN
								</label>
							</div>
							<div class="form-group">
								<label>
									<input type="checkbox" name="apbd_satu">
									APBD I
								</label>
							</div>
							<div class="form-group">
								<label>
									<input type="checkbox" name="apbd_dua">
									APBD II
								</label>
							</div>
							<div class="form-group">
								<label>
									<input type="checkbox" name="swasta">
									SWASTA
								</label>
							</div>
							<div class="form-group">
									<label>Keterangan</label>
									<input type="text" name="keterangan" class="form-control">
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

	<!-- =========================== / CONTENT =========================== -->
