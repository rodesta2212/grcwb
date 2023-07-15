<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal_rinci_pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id_pelatihan = isset($_GET['id_pelatihan']) ? $_GET['id_pelatihan']: '';

	$JadwalRinciPelatihan = new JadwalRinciPelatihan($db);
	$JadwalRinciPelatihan->id_pelatihan = $id_pelatihan;
?>

<!-- header -->
<?php include("header.php"); ?>

<body>
	<!-- head navbar -->
	<?php include("head-navbar.php"); ?>

	<!-- right sidebar -->
	<?php include("right-sidebar.php"); ?>

	<!-- left sidebar -->
    <?php include("left-sidebar.php"); ?>
    
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-analytics1"></i> Laporan Peserta</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
						<form action="laporan-peserta-search.php" method="POST">
							<div class="row" style="padding-left:10px;">
								<select class="form-control custom-select2 col-4" name="id_pelatihan" required>
									<option <?php if($id_pelatihan == ''): ?> selected <?php endif ?> disabled>ALL</option>
									<?php $JadwalRinciPelatihans = $JadwalRinciPelatihan->pelatihanSelesai(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
										<option value="<?=$row['id_pelatihan']?>" <?php if($row['id_pelatihan'] == $id_pelatihan): ?> selected <?php endif ?>><?=ucwords($row['nama_pelatihan'])?></option>
									<?php endwhile; ?>
								</select>
								<div class="col-2">
									<button type="submit" class="btn btn-success" style="height:100%;"><i class="icon-copy dw dw-search2"></i></button>
								</div>
							</div>
						</form>
					</div>
                    <div class="pb-20">
						<table class="table hover multiple-select-row data-table-export nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama Peserta</th>
                                    <th>Pelatihan</th>
                                    <th>Program</th>
                                    <th>Pembayaran</th>
                                    <th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php if($id_pelatihan == ''): ?>
									<?php $no=1; $JadwalRinciPelatihans = $JadwalRinciPelatihan->laporanPeserta(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
										<?php if($row['status_pelatihan'] != 'mendaftar' && $row['status_pembayaran'] != 'menunggu konfirmasi'):?>
											<tr class="text-center">
												<td><?=$no?></td>
												<td><?=ucwords($row['nama_peserta'])?></td>
												<td><?=ucwords($row['nama_pelatihan'])?></td>
												<td><?=ucwords($row['nama_program'])?></td>
												<td><?=ucwords($row['status_pembayaran'])?></td>
												<td><?=ucwords($row['status_pelatihan'])?></td>
											</tr>
										<?php endif ?>
									<?php $no++; endwhile; ?>
								<?php else: ?>
									<?php $no=1; $JadwalRinciPelatihans = $JadwalRinciPelatihan->laporanPesertaSearch(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
										<?php if($row['status_pelatihan'] != 'mendaftar' && $row['status_pembayaran'] != 'menunggu konfirmasi'):?>
											<tr class="text-center">
												<td><?=$no?></td>
												<td><?=ucwords($row['nama_peserta'])?></td>
												<td><?=ucwords($row['nama_pelatihan'])?></td>
												<td><?=ucwords($row['nama_program'])?></td>
												<td><?=ucwords($row['status_pembayaran'])?></td>
												<td><?=ucwords($row['status_pelatihan'])?></td>
											</tr>
										<?php endif ?>
									<?php $no++; endwhile; ?>
								<?php endif ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
</body>
</html>
