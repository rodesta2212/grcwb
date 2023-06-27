<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/jadwal_rinci_pelatihan.inc.php');
    include_once('includes/pelatihan.inc.php');
    include_once('includes/program.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $JadwalRinciPelatihan = new JadwalRinciPelatihan($db);

	$Pelatihan = new Pelatihan($db);
	$Pelatihan->id_pelatihan = $id;
	$Pelatihan->readOne();

    $Program = new Program($db);
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

    <?php
		if($_POST){
			// post data
			$JadwalRinciPelatihan->id_jadwal_rinci_pelatihan = $_POST["id_jadwal_rinci_pelatihan"];
            $JadwalRinciPelatihan->id_peserta = $_POST["id_peserta"];
            $JadwalRinciPelatihan->id_pelatihan = $_POST["id_pelatihan"];
            $JadwalRinciPelatihan->id_program = $_POST["id_program"];
			$JadwalRinciPelatihan->status_pelatihan = $_POST["status_pelatihan"];
			$JadwalRinciPelatihan->status_pembayaran = $_POST["status_pembayaran"];
			$JadwalRinciPelatihan->file_pembayaran = $_POST["file_pembayaran"];

			if ($JadwalRinciPelatihan->insert()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='dashboard.php'</script>";
			} else {
				echo '<script language="javascript">';
                echo 'alert("Data Gagal Terkirim")';
                echo '</script>';
			}
		}
	?>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Simple Datatable start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4"><i class="dw dw-open-book"></i> Data Pendaftaran</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<div style="padding-right:15px; display:flex; justify-content:right; align-items:center;">
                            <!-- <a href="ujian-create"> -->
                                <button type="submit" class="btn btn-success">Daftar</button>
                            <!-- </a> -->
                        </div>
                        <!-- hidden -->
						<input type="hidden" name="id_jadwal_rinci_pelatihan" value="<?php echo $JadwalRinciPelatihan->getNewId(); ?>">
                        <input type="hidden" name="id_peserta" value="<?php echo $_SESSION['id_peserta']; ?>">
                        <input type="hidden" name="id_pelatihan" value="<?php echo $Pelatihan->id_pelatihan; ?>">
						<input type="hidden" name="status_pelatihan" value="mendaftar">
						<input type="hidden" name="status_pembayaran" value="menunggu pembayaran">
						<input type="hidden" name="file_pembayaran" value="">
                        <!-- hidden -->
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
								<div class="form-group">
									<label>Program<span style="color:red;">*</span></label>
									<select class="form-control custom-select2" name="id_program" required>
										<!-- <option selected disabled>Pilih...</option> -->
										<?php $Programs = $Program->readAll(); while ($row = $Programs->fetch(PDO::FETCH_ASSOC)) : ?>
											<option value="<?=$row['id_program']?>"><?=ucwords($row['nama'])?> (Rp.<?=number_format($row['biaya'],0,',','.')?>)</option>
										<?php endwhile; ?>
									</select>
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
			</div>

			<div class="page-header">
				<div class="row">
					<div class="col-12  mb-20">
						<div class="title">
							<h4>Daftar Program</h4>
						</div>
					</div>
					<?php $i=0; $Programs = $Program->readActive(); while ($row = $Programs->fetch(PDO::FETCH_ASSOC)) : ?>
						<div class="col-md-3 mb-20">
							<div class="card-box d-block mx-auto pd-20 text-secondary">
								<div class="img pb-30">
									<img src="upload/<?=$row['gambar']?>" alt="<?=$row['gambar']?>">
								</div>
								<div class="content">
									<h3 class="h4"><?=ucwords($row['nama'])?></h3>
									<p class="max-width-200">
										<?php 
											$time_mulai = strtotime($row['jam_mulai']);
											$time_selesai = strtotime($row['jam_selesai']); 
										?>
										<h6>
											Biaya : Rp. <?=number_format($row['biaya'],0,',','.')?>
										</h6>
										<h6>
											Pelaksanaan : <?=date('H:i', $time_mulai);?> - <?=date('H:i', $time_selesai);?>
										</h6>
										<br/>
									</p>
									<div class="row" style="margin-left: 0px !important;">
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck1-1" disabled="disabled" <?php if($row['senin'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck1-1">Senin</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck2-1" disabled="disabled" <?php if($row['jumat'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck2-1">Jum'at</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck3-1" disabled="disabled" <?php if($row['selasa'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck3-1">Selasa</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck4-1" disabled="disabled" <?php if($row['sabtu'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck4-1">Sabtu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck5-1" disabled="disabled" <?php if($row['rabu'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck5-1">Rabu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck6-1" disabled="disabled" <?php if($row['minggu'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck6-1">Minggu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
											<input type="checkbox" class="custom-control-input" id="customCheck7-1" disabled="disabled" <?php if($row['kamis'] == 'YES'): ?> checked="checked" <?php endif; ?>>
											<label class="custom-control-label" for="customCheck7-1">Kamis</label>
										</div>
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
    <?php include("script.php"); ?>
</body>
</html>
