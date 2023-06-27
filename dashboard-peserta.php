<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/jadwal_rinci_pelatihan.inc.php');
    include_once('includes/pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $JadwalRinciPelatihan = new JadwalRinciPelatihan($db);
	$JadwalRinciPelatihan->id_pelatihan = $id;

	$Pelatihan = new Pelatihan($db);
	$Pelatihan->id_pelatihan = $id;
	$Pelatihan->readOne();
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
						<h4 class="text-blue h4"><i class="dw dw-open-book"></i> Data Pelatihan</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
                        <!-- horizontal Basic Forms Start -->
                        <div class="pd-20 mb-30 row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Nama Pelatihan</label>
                                    <input type="text" class="form-control" value="<?php echo $Pelatihan->nama; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" style="height:150px;" readonly><?php echo $Pelatihan->deskripsi; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="form-control" value="<?php echo $Pelatihan->tgl_mulai; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" class="form-control" value="<?php echo $Pelatihan->tgl_selesai; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group img pb-30">
									<img src="upload/<?=$Pelatihan->gambar;?>" alt="<?=$Pelatihan->gambar;?>">
								</div>
                            </div>
                        </div>
					</form>
				</div>
				<!-- Simple Datatable End -->

				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Daftar Peserta</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama</th>
									<th>Jenis Kelamin</th>
									<th>Email</th>
									<th>No. HP</th>
									<th>Alamat</th>
                                    <th>Program</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $JadwalRinciPelatihans = $JadwalRinciPelatihan->readPesertaPelatihan(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=ucwords($row['nama_peserta'])?></td>
									<td>
										<?php if($row['jenis_kelamin'] == 'laki'): ?>
											Laki - Laki
										<?php else: ?>
											Perempuan
										<?php endif; ?>
									</td>
									<td><?=$row['email']?></td>
									<td>+62<?=$row['telp']?></td>
									<td><?=ucwords($row['alamat'])?></td>
									<td><?=ucwords($row['nama_program'])?></td>
								</tr>
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
