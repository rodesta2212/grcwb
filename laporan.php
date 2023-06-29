<!DOCTYPE html>
<html>

<?php
    include("config.php");
	include_once('includes/jadwal_rinci_pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$tgl_mulai = isset($_GET['tgl_mulai']) ? $_GET['tgl_mulai'] : die('ERROR: missing Tgl Mulai.');
	$tgl_selesai = isset($_GET['tgl_selesai']) ? $_GET['tgl_selesai'] : die('ERROR: missing Tgl Selesai.');

	$JadwalRinciPelatihan = new JadwalRinciPelatihan($db);
	$JadwalRinciPelatihan->tgl_mulai = $tgl_mulai;
	$JadwalRinciPelatihan->tgl_selesai = $tgl_selesai;

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
						<h4 class="text-blue h4"><i class="dw dw-analytics1"></i> Laporan Pelatihan</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
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
                                <?php $no=1; $JadwalRinciPelatihans = $JadwalRinciPelatihan->laporan(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
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
