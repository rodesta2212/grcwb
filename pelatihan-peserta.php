<!DOCTYPE html>
<html>

<?php
	include("config.php");
    include_once('includes/pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();

	$Pelatihan = new Pelatihan($db);
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
		<div class="pd-ltr-20">
			<div class="page-header">
				<div class="row">
					<div class="col-12  mb-20">
						<div class="title">
							<h4>Daftar Pelatihan</h4>
						</div>
					</div>
					<?php $i=0; $Pelatihans = $Pelatihan->readActive(); while ($row = $Pelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
						<div class="col-md-4 mb-20">
							<div class="card-box d-block mx-auto pd-20 text-secondary">
								<div class="img pb-30">
									<img src="upload/<?=$row['gambar']?>" alt="<?=$row['gambar']?>">
								</div>
								<div class="content">
									<h3 class="h4"><?=ucwords($row['nama'])?></h3>
									<p class="max-width-200">
										<?php 
											$date_mulai = strtotime($row['tgl_mulai']);
											$date_selesai = strtotime($row['tgl_selesai']); 
										?>
										<h6>
											<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?>
										</h6>
										<br/>
										<?=$row['deskripsi']?>
									</p>
									<div style="display: flex; justify-content: center; align-items: center;">
										<a href="pelatihan-daftar.php?id=<?php echo $row['id_pelatihan']; ?>" class="btn btn-primary btn-sm">Daftar Sekarang</a>
									</div>
								</div>
							</div>
						</div>
					<?php $i++; endwhile; ?>
				</div>
			</div>

			<!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
	<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="vendors/scripts/dashboard.js"></script>
</body>
</html>