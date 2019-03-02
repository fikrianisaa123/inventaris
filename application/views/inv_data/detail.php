<!-- =========================== CONTENT =========================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <a href="<?php echo base_url('inventory/all') ?>" class="btn btn-primary">Kembali</a>
  </section>

  <!-- Main content -->
  <section class="content">
		<div class="box">
      <div class="box-header">
        <h3 class="box-title">Detail Data <?php echo $detail[0]['jenis_peralatan']; ?></h3>
      </div>
      
      <div class="box-body">
        <table class="table table-hover table-bordered">
          <img src="<?php echo base_url('assets/uploads/images/inventory/').$detail[0]['nama_file']; ?>" class="img-responsive">
          <tbody>
            <tr>
              <th class="active">Kategori Peralatan</th>
              <td><?php echo $detail[0]['kategori']; ?></td>
            </tr>
            <tr>
              <th class="active">Nama Peralatan</th>
              <td><?php echo $detail[0]['jenis_peralatan']; ?></td>
            </tr>
            <tr>
              <th class="active">Jumlah Peralatan</th>
              <td><?php echo $detail[0]['jumlah']; ?></td>
            </tr>
            <tr>
              <th class="active">Kondisi Baik</th>
              <td><?php echo $detail[0]['baik']; ?></td>
            </tr>
            <tr>
              <th class="active">Kondisi Rusak</th>
              <td><?php echo $detail[0]['rusak']; ?></td>
            </tr>
            <tr>
              <th class="active">Sumber Dana APBN</th>
              <td><?php echo $detail[0]['apbn']; ?></td>
            </tr>
            <tr>
              <th class="active">Sumber Dana APBD Satu</th>
              <td><?php echo $detail[0]['apbd_satu']; ?></td>
            </tr>
            <tr>
              <th class="active">Sumber Dana APBD Dua</th>
              <td><?php echo $detail[0]['apbd_dua']; ?></td>
            </tr>
            <tr>
              <th class="active">Sumber Dana Swasta</th>
              <td><?php echo $detail[0]['swasta']; ?></td>
            </tr>
            <tr>
              <th class="active">Keterangan</th>
              <td><?php echo $detail[0]['keterangan']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
