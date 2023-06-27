<!DOCTYPE html>
<html>

<?php
	include("config.php");
	include_once('includes/jadwal_rinci_pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
	$config = new Config(); $db = $config->getConnection();

	$JadwalRinciPelatihan = new JadwalRinciPelatihan($db);
	$JadwalRinciPelatihan->id_peserta = isset($_SESSION['id_peserta']) ? $_SESSION['id_peserta']:'';
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
			<?php if ($_SESSION['role'] == 'admin'): ?>
				<div class="page-header">
					<div class="row">
						<div class="col-12  mb-20">
							<div class="title">
								<h4>Daftar Menunggu Konfirmasi :</h4>
							</div>
						</div>
						<?php $i=0; $JadwalRinciPelatihans = $JadwalRinciPelatihan->readMenungguKorfirmasi(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
							<div class="col-md-4 mb-20">
								<div class="card-box d-block mx-auto pd-20 text-secondary">
									<div class="img pb-30">
										<img src="upload/<?=$row['gambar_pelatihan']?>" alt="<?=$row['gambar_pelatihan']?>">
									</div>
									<div class="content">
										<h3 class="h4"><?=ucwords($row['nama_pelatihan'])?></h3>
										<p class="max-width-200">
											<?php 
												$date_mulai = strtotime($row['tgl_mulai']);
												$date_selesai = strtotime($row['tgl_selesai']); 
												$time_mulai = strtotime($row['jam_mulai']);
												$time_selesai = strtotime($row['jam_selesai']); 
											?>
											<h6>
												Program : <?=ucwords($row['nama_program'])?> (Rp.<?=number_format($row['biaya'],0,',','.')?>)
											</h6>
											<h6>
												<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?> (<?=date('H:i', $time_mulai);?> - <?=date('H:i', $time_selesai);?>)
											</h6>
											<br/>
										</p>
										<h3 class="h4">Peserta : <?=ucwords($row['nama_peserta'])?></h3>
										<?php if ($row['status_pembayaran'] == 'menunggu konfirmasi'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalPembayaran<?=$i?>">Konfirmasi Pembayaran</button>
											</div>
											<!-- Modal Create-->
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

													if($JadwalRinciPelatihan->updateStatus()){
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
											<div class="modal fade" id="modalPembayaran<?=$i?>" role="dialog">
												<div class="modal-dialog">
													<form method="POST" enctype="multipart/form-data">
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Bukti Pembayaran</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<!-- hidden form -->
																<input type="hidden" name="id_jadwal_rinci_pelatihan" value="<?php echo $row['id_jadwal_rinci_pelatihan']; ?>">
																<input type="hidden" name="id_peserta" value="<?php echo $row['id_peserta']; ?>">
																<input type="hidden" name="id_pelatihan" value="<?php echo $row['id_pelatihan']; ?>">
																<input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
																<input type="hidden" name="status_pelatihan" value="<?php echo $row['status_pelatihan']; ?>">
																<input type="hidden" name="status_pembayaran" value="terkonfirmasi">
																<input type="hidden" name="file_pembayaran" value="<?php echo $row['file_pembayaran']; ?>">
																<!-- hidden form -->
																<div class="form-group row">
																	<img id="file_img" src="upload/<?php echo $row['file_pembayaran']; ?>" alt="<?php echo $row['file_pembayaran']; ?>" style="width:100%;">
																</div>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
																<button type="submit" class="btn btn-success">Konfirmasi</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										<?php elseif ($row['status_pembayaran'] == 'terkonfirmasi' && $row['status_pelatihan'] == 'pelatihan'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalStatus<?=$i?>">Konfirmasi Status Pelatihan</button>
											</div>
											<!-- Modal Create-->
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

													if($JadwalRinciPelatihan->updateStatus()){
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
											<div class="modal fade" id="modalStatus<?=$i?>" role="dialog">
												<div class="modal-dialog">
													<form method="POST" enctype="multipart/form-data">
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Status Pelatihan</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<!-- hidden form -->
																<input type="hidden" name="id_jadwal_rinci_pelatihan" value="<?php echo $row['id_jadwal_rinci_pelatihan']; ?>">
																<input type="hidden" name="id_peserta" value="<?php echo $row['id_peserta']; ?>">
																<input type="hidden" name="id_pelatihan" value="<?php echo $row['id_pelatihan']; ?>">
																<input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
																<input type="hidden" name="status_pelatihan" value="<?php echo $row['status_pelatihan']; ?>">
																<input type="hidden" name="status_pembayaran" value="<?php echo $row['status_pembayaran']; ?>">
																<input type="hidden" name="file_pembayaran" value="<?php echo $row['file_pembayaran']; ?>">
																<!-- hidden form -->
																<div class="form-group">
																	<label>Status Pelatihan<span style="color:red;">*</span></label>
																	<select class="form-control" name="status_pelatihan" required>
																		<option selected disabled>Pilih...</option>
																		<option value="lulus">Lulus</option>
																		<option value="tidak lulus">Tidak Lulus</option>
																	</select>
																</div>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
																<button type="submit" class="btn btn-success">Konfirmasi</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php $i++; endwhile; ?>

						<?php if ($i == 0): ?>
							<div class="col-12" style="display: flex; justify-content: center; align-items: center;">
								<h6>Tidak Ada Pelatihan Yang Harus Di Konfirmasi</h6>
							</div>
						<?php endif;?>

					</div>
				</div>
				<div class="page-header">
					<div class="row">
						<div class="col-12  mb-20">
							<div class="title">
								<h4>Daftar Pelatihan Berjalan :</h4>
							</div>
						</div>
						<?php $i=0; $JadwalRinciPelatihans = $JadwalRinciPelatihan->readNow(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
							<div class="col-md-4 mb-20">
								<div class="card-box d-block mx-auto pd-20 text-secondary">
									<div class="img pb-30">
										<img src="upload/<?=$row['gambar_pelatihan']?>" alt="<?=$row['gambar_pelatihan']?>">
									</div>
									<div class="content">
										<h3 class="h4"><?=ucwords($row['nama_pelatihan'])?></h3>
										<p class="max-width-200">
											<?php 
												$date_mulai = strtotime($row['tgl_mulai']);
												$date_selesai = strtotime($row['tgl_selesai']); 
											?>
											<h6>
												<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?>
											</h6>
										</p>
										<div style="display: flex; justify-content: center; align-items: center;">
											<a href="dashboard-peserta.php?id=<?php echo $row['id_pelatihan']; ?>" class="btn btn-primary btn-sm">Daftar Peserta</a>
										</div>
									</div>
								</div>
							</div>
						<?php $i++; endwhile; ?>

						<?php if ($i == 0): ?>
							<div class="col-12" style="display: flex; justify-content: center; align-items: center;">
								<h6>Tidak Ada Pelatihan Yang Sedang Berjalan</h6>
							</div>
						<?php endif;?>

					</div>
				</div>
			<?php elseif ($_SESSION['role'] == 'peserta'): ?>
				<div class="page-header">
					<div class="row">
						<div class="col-12  mb-20">
							<div class="title">
								<h4>Daftar Pelatihan Yang Diikuti :</h4>
							</div>
						</div>
						<?php $i=0; $JadwalRinciPelatihans = $JadwalRinciPelatihan->readPeserta(); while ($row = $JadwalRinciPelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
							<div class="col-md-4 mb-20">
								<div class="card-box d-block mx-auto pd-20 text-secondary">
									<div class="img pb-30">
										<img src="upload/<?=$row['gambar_pelatihan']?>" alt="<?=$row['gambar_pelatihan']?>">
									</div>
									<div class="content">
										<h3 class="h4"><?=ucwords($row['nama_pelatihan'])?></h3>
										<p class="max-width-200">
											<?php 
												$date_mulai = strtotime($row['tgl_mulai']);
												$date_selesai = strtotime($row['tgl_selesai']); 
												$time_mulai = strtotime($row['jam_mulai']);
												$time_selesai = strtotime($row['jam_selesai']); 
											?>
											<h6>
												Program : <?=ucwords($row['nama_program'])?> (Rp.<?=number_format($row['biaya'],0,',','.')?>)
											</h6>
											<h6>
												<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?> (<?=date('H:i', $time_mulai);?> - <?=date('H:i', $time_selesai);?>)
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
										<?php if ($row['status_pembayaran'] == 'menunggu pembayaran'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalPembayaran<?=$i?>">Kirim Bukti Pembayaran</button>
											</div>
											<!-- Modal Create-->
											<?php
												// upload file
												if(isset($_FILES['file_pembayaran'])){
													$errors= array();
													$file_name = str_replace(" ", "-", $_FILES['file_pembayaran']['name']);
													$file_size =$_FILES['file_pembayaran']['size'];
													$file_tmp =$_FILES['file_pembayaran']['tmp_name'];
													$file_type=$_FILES['file_pembayaran']['type'];
													$tmp = explode('.', $file_name);
													$file_extension = end($tmp);
													$extensions= array("jpeg","jpg","png","pdf");
													
													if(in_array($file_extension,$extensions)=== false){
														// $errors[]="extension not allowed, please choose a JPEG or PNG file.";
													}
													
													if($file_size > 20097152){
														$errors[]='File size must be excately 20 MB';
													}
													
													if(empty($errors)==true){
														move_uploaded_file($file_tmp,"upload/".$file_name);
														// echo "Success";
														
													}else{
														print_r($errors);
													}
												}
												if($_POST){
													// post data
													$JadwalRinciPelatihan->id_jadwal_rinci_pelatihan = $_POST["id_jadwal_rinci_pelatihan"];
													$JadwalRinciPelatihan->id_peserta = $_POST["id_peserta"];
													$JadwalRinciPelatihan->id_pelatihan = $_POST["id_pelatihan"];
													$JadwalRinciPelatihan->id_program = $_POST["id_program"];
													$JadwalRinciPelatihan->status_pelatihan = $_POST["status_pelatihan"];
													$JadwalRinciPelatihan->status_pembayaran = $_POST["status_pembayaran"];

													// post name img
													if (!empty($_FILES['file_pembayaran']['name'])){
														$JadwalRinciPelatihan->file_pembayaran = $_FILES['file_pembayaran']['name'];
													}

													if($JadwalRinciPelatihan->updateStatus()){
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
											<div class="modal fade" id="modalPembayaran<?=$i?>" role="dialog">
												<div class="modal-dialog">
													<form method="POST" enctype="multipart/form-data">
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Upload Bukti Pembayaran</h4>
																<button type="button" class="close" data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<!-- hidden form -->
																<input type="hidden" name="id_jadwal_rinci_pelatihan" value="<?php echo $row['id_jadwal_rinci_pelatihan']; ?>">
																<input type="hidden" name="id_peserta" value="<?php echo $row['id_peserta']; ?>">
																<input type="hidden" name="id_pelatihan" value="<?php echo $row['id_pelatihan']; ?>">
																<input type="hidden" name="id_program" value="<?php echo $row['id_program']; ?>">
																<input type="hidden" name="status_pelatihan" value="pelatihan">
																<input type="hidden" name="status_pembayaran" value="menunggu konfirmasi">
																<!-- hidden form -->
																<div class="form-group row">
																	<label class="col-sm-4 col-form-label">Bukti Pembayaran<span style="color:red;">*</span></label>
																	<div class="col-sm-8">
																		<input type="file" class="form-control" name="file_pembayaran" required>
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
																<button type="submit" class="btn btn-success">Kirim</button>
															</div>
														</div>
													</form>
												</div>
											</div>

										<?php elseif ($row['status_pembayaran'] == 'menunggu konfirmasi'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<a href="#" class="btn btn-warning btn-sm">Menunggu Konfirmasi Pembayaran</a>
											</div>
										<?php elseif ($row['status_pembayaran'] == 'terkonfirmasi' && $row['status_pelatihan'] == 'pelatihan'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<a href="#" class="btn btn-info btn-sm">Pembayaran Terkonfirmasi (Proses Pelatihan)</a>
											</div>
										<?php elseif ($row['status_pembayaran'] == 'terkonfirmasi' && $row['status_pelatihan'] == 'tidak lulus'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<a href="#" class="btn btn-danger btn-sm">Anda Tidak Lulus Pelatihan</a>
											</div>
										<?php elseif ($row['status_pembayaran'] == 'terkonfirmasi' && $row['status_pelatihan'] == 'lulus'): ?>
											<div style="display: flex; justify-content: center; align-items: center;">
												<a href="sertifikat.php?id=<?php echo $_SESSION['id_peserta']; ?>" class="btn btn-success btn-sm">Anda Lulus Pelatihan (Cetak Sertifikat)</a>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php $i++; endwhile; ?>

						<?php if ($i == 0): ?>
							<div class="col-12" style="display: flex; justify-content: center; align-items: center;">
								<h6>Anda Belum Mengikuti Pelatihan Apapun</h6>
							</div>
						<?php endif;?>

						<div class="col-12" style="margin-top:40px; display: flex; justify-content: center; align-items: center;">
							<a href="pelatihan-peserta.php" class="btn btn-success btn-sm">Daftar Pelatihan</a>
						</div>

					</div>
				</div>
			<?php endif; ?>
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