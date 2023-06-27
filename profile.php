<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/guru.inc.php');
    include_once("includes/user.inc.php");

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID.');

	$Guru = new Guru($db);
	$Guru->id_guru = $id;
	$Guru->readOne();

	$User = new User($db);
	$User->id_user = $id_user;
	$User->readOne();

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
		// gambar fc izajah
		if(isset($_FILES['fc_ijazah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_ijazah']['name']);
			$file_size =$_FILES['fc_ijazah']['size'];
			$file_tmp =$_FILES['fc_ijazah']['tmp_name'];
			$file_type=$_FILES['fc_ijazah']['type'];
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

		// gambar fc sk sekolah
		if(isset($_FILES['fc_sk_sekolah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_sk_sekolah']['name']);
			$file_size =$_FILES['fc_sk_sekolah']['size'];
			$file_tmp =$_FILES['fc_sk_sekolah']['tmp_name'];
			$file_type=$_FILES['fc_sk_sekolah']['type'];
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

		// gambar fc sk GTT
		if(isset($_FILES['fc_sk_gtt'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_sk_gtt']['name']);
			$file_size =$_FILES['fc_sk_gtt']['size'];
			$file_tmp =$_FILES['fc_sk_gtt']['tmp_name'];
			$file_type=$_FILES['fc_sk_gtt']['type'];
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

		// gambar fc kartu angggota muhammadiyah
		if(isset($_FILES['fc_kartu_anggota_muhammadiyah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_kartu_anggota_muhammadiyah']['name']);
			$file_size =$_FILES['fc_kartu_anggota_muhammadiyah']['size'];
			$file_tmp =$_FILES['fc_kartu_anggota_muhammadiyah']['tmp_name'];
			$file_type=$_FILES['fc_kartu_anggota_muhammadiyah']['type'];
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

		// gambar fc sk kartu keluarga
		if(isset($_FILES['fc_kartu_keluarga'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['fc_kartu_keluarga']['name']);
			$file_size =$_FILES['fc_kartu_keluarga']['size'];
			$file_tmp =$_FILES['fc_kartu_keluarga']['tmp_name'];
			$file_type=$_FILES['fc_kartu_keluarga']['type'];
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

		// gambar sk membaca Al Quran
		if(isset($_FILES['sk_membaca_alquran'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_membaca_alquran']['name']);
			$file_size =$_FILES['sk_membaca_alquran']['size'];
			$file_tmp =$_FILES['sk_membaca_alquran']['tmp_name'];
			$file_type=$_FILES['sk_membaca_alquran']['type'];
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

		// gambar fc sk aktif kegiatan muhammadiyah
		if(isset($_FILES['sk_aktif_kegiatan_muhammadiyah'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_aktif_kegiatan_muhammadiyah']['name']);
			$file_size =$_FILES['sk_aktif_kegiatan_muhammadiyah']['size'];
			$file_tmp =$_FILES['sk_aktif_kegiatan_muhammadiyah']['tmp_name'];
			$file_type=$_FILES['sk_aktif_kegiatan_muhammadiyah']['type'];
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

		// gambar fc sk pernyataan ketentuan dikdasmen
		if(isset($_FILES['sk_pernyataan_ketentuan_dikdasmen'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['sk_pernyataan_ketentuan_dikdasmen']['name']);
			$file_size =$_FILES['sk_pernyataan_ketentuan_dikdasmen']['size'];
			$file_tmp =$_FILES['sk_pernyataan_ketentuan_dikdasmen']['tmp_name'];
			$file_type=$_FILES['sk_pernyataan_ketentuan_dikdasmen']['type'];
			$tmp = explode('.', $file_name);
			$file_extension = end($tmp);
			$extensions= array("jpeg","jpg","png","pdf");
			
			if(in_array($file_extension,$extensions)=== false){
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
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

		if ($_POST) {
			$Guru->id_guru = $_POST["id_guru"];
			$Guru->nama = $_POST["nama"];
			$Guru->tgl_lahir = $_POST["tgl_lahir"];
			$Guru->jenis_kelamin = $_POST["jenis_kelamin"];
			$Guru->telp = $_POST["telp"];
			$Guru->email = $_POST["email"];
			$Guru->tempat_kelahiran = $_POST["tempat_kelahiran"];
			$Guru->agama = $_POST["agama"];
			$Guru->pendidikan = $_POST["pendidikan"];
			$Guru->nama_lembaga = $_POST["nama_lembaga"];
			$Guru->tahun_ijazah = $_POST["tahun_ijazah"];
			$Guru->jumlah_program_study = $_POST["jumlah_program_study"];
			$Guru->alamat = $_POST["alamat"];
			$Guru->status_perkawinan= $_POST["status_perkawinan"];
			$Guru->tanggal_mulai_bertugas = $_POST["tanggal_mulai_bertugas"];
			$Guru->tingkatan = $_POST["tingkatan"];

			if (!empty($_FILES['fc_ijazah']['name'])){
				$Guru->fc_ijazah = $_FILES['fc_ijazah']['name'];
			} else{
				$Guru->fc_ijazah = $Guru->fc_ijazah;
			}

			if (!empty($_FILES['fc_sk_sekolah']['name'])){
				$Guru->fc_sk_sekolah = $_FILES['fc_sk_sekolah']['name'];
			} else{
				$Guru->fc_sk_sekolah = $Guru->fc_sk_sekolah;
			}

			if (!empty($_FILES['fc_sk_gtt']['name'])){
				$Guru->fc_sk_gtt = $_FILES['fc_sk_gtt']['name'];
			} else{
				$Guru->fc_sk_gtt = $Guru->fc_sk_gtt;
			}

			if (!empty($_FILES['fc_kartu_anggota_muhammadiyah']['name'])){
				$Guru->fc_kartu_anggota_muhammadiyah = $_FILES['fc_kartu_anggota_muhammadiyah']['name'];
			} else{
				$Guru->fc_kartu_anggota_muhammadiyah = $Guru->fc_kartu_anggota_muhammadiyah;
			}

			if (!empty($_FILES['fc_kartu_keluarga']['name'])){
				$Guru->fc_kartu_keluarga = $_FILES['fc_kartu_keluarga']['name'];
			} else{
				$Guru->fc_kartu_keluarga = $Guru->fc_kartu_keluarga;
			}

			if (!empty($_FILES['sk_pernyataan_ketentuan_dikdasmen']['name'])){
				$Guru->sk_pernyataan_ketentuan_dikdasmen = $_FILES['sk_pernyataan_ketentuan_dikdasmen']['name'];
			} else{
				$Guru->sk_pernyataan_ketentuan_dikdasmen = $Guru->sk_pernyataan_ketentuan_dikdasmen;
			}

			if (!empty($_FILES['sk_membaca_alquran']['name'])){
				$Guru->sk_membaca_alquran = $_FILES['sk_membaca_alquran']['name'];
			} else{
				$Guru->sk_membaca_alquran = $Guru->sk_membaca_alquran;
			}

			if (!empty($_FILES['sk_aktif_kegiatan_muhammadiyah']['name'])){
				$Guru->sk_aktif_kegiatan_muhammadiyah = $_FILES['sk_aktif_kegiatan_muhammadiyah']['name'];
			} else{
				$Guru->sk_aktif_kegiatan_muhammadiyah = $Guru->sk_aktif_kegiatan_muhammadiyah;
			}
			

			// var_dump($_FILES['fc_ijazah']['name']);

			if ($Guru->update()) {
				echo '<script language="javascript">';
				echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='index.php'</script>";
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
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<!-- <div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<img src="vendors/images/photo1.jpg" alt="" class="avatar-photo">
								<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-body pd-5">
												<div class="img-container">
													<img id="image" src="vendors/images/photo2.jpg" alt="Picture">
												</div>
											</div>
											<div class="modal-footer">
												<input type="submit" value="Update" class="btn btn-primary">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div> -->
							<h5 class="text-center h5 mb-0"><?php echo ucwords($Guru->nama); ?></h5>
							<p class="text-center text-muted font-14"><?php echo ucwords($Guru->status); ?></p>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email :</span>
										<?php echo $Guru->email; ?>
									</li>
									<li>
										<span>No Telp :</span>
										<?php echo $Guru->telp; ?>
									</li>
									<li>
										<span>Alamat :</span>
										<?php echo $Guru->alamat; ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Profile</a>
										</li>
									</ul>
									<div class="tab-content">
										<!-- Setting Tab start -->
										<div class="tab-pane fade show active" id="setting" role="tabpanel">
											<div class="profile-setting">
												<form method="post" enctype="multipart/form-data">
												<!-- hidden -->
												<input type="hidden" name="id_guru" value="<?php echo $Guru->id_guru; ?>">
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Profil</h4>
															<div class="form-group">
																<label>Nama Lengkap</label>
																<input class="form-control form-control-lg" type="text" name="nama" value="<?php echo $Guru->nama; ?>" required>
															</div>
															<div class="form-group">
																<label>Tempat Kelahiran</label>
																<input class="form-control form-control-lg" type="text" name="tempat_kelahiran" value="<?php echo $Guru->tempat_kelahiran; ?>" required>
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $Guru->email; ?>" required>
															</div>
															<div class="form-group">
																<label>Tanggal Lahir</label>
																<input class="form-control form-control-lg" type="date" name="tgl_lahir" value="<?php echo $Guru->tgl_lahir; ?>" required>
															</div>
															<div class="form-group">
																<label>Jenis Kelamin</label>
																<div class="d-flex">
																	<?php if($Guru->jenis_kelamin == 'laki'): ?>
																	<div class="custom-control custom-radio mb-5 mr-20">
																		<input type="radio" id="customRadio4" name="jenis_kelamin" value="laki" class="custom-control-input" checked>
																		<label class="custom-control-label weight-400" for="customRadio4">Laki - laki</label>
																	</div>
																	<div class="custom-control custom-radio mb-5">
																		<input type="radio" id="customRadio5" name="jenis_kelamin" value="perempuan" class="custom-control-input">
																		<label class="custom-control-label weight-400" for="customRadio5">Perempuan</label>
																	</div>
																	<?php else: ?>
																		<div class="custom-control custom-radio mb-5 mr-20">
																			<input type="radio" id="customRadio4" name="jenis_kelamin" value="laki" class="custom-control-input">
																			<label class="custom-control-label weight-400" for="customRadio4">Laki - laki</label>
																		</div>
																		<div class="custom-control custom-radio mb-5">
																			<input type="radio" id="customRadio5" name="jenis_kelamin" value="perempuan" class="custom-control-input" checked>
																			<label class="custom-control-label weight-400" for="customRadio5">Perempuan</label>
																		</div>
																	<?php endif; ?>
																</div>
															</div>
															<div class="form-group">
																<label>No Telpon</label>
																<input class="form-control form-control-lg" type="text" name="telp" min="0" value="<?php echo $Guru->telp; ?>" required>
															</div>
															<div class="form-group">
																<label>Alamat</label>
																<textarea class="form-control" name="alamat" required><?php echo $Guru->alamat; ?></textarea>
															</div>
															<div class="form-group">
																<label>Agama</label>
																<input class="form-control form-control-lg" type="text" name="agama" value="<?php echo $Guru->agama; ?>" required>
															</div>
															<div class="form-group">
																<label>Pendidikan</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" name="pendidikan" required>
																	<option value="D3" <?php if($Guru->pendidikan == 'D3'): ?> selected <?php endif; ?>>D3</option>
																	<option value="S1" <?php if($Guru->pendidikan == 'S1'): ?> selected <?php endif; ?> >S1</option>
																	<option value="S2" <?php if($Guru->pendidikan == 'S2'): ?> selected <?php endif; ?> >S2</option>
																</select>
															</div>
															<div class="form-group">
																<label>Nama lembaga</label>
																<input class="form-control form-control-lg" type="text" name="nama_lembaga" value="<?php echo $Guru->nama_lembaga; ?>" required>
															</div>
															<div class="form-group">
																<label>Tahun Ijazah</label>
																<input class="form-control form-control-lg" type="text" name="tahun_ijazah" value="<?php echo $Guru->tahun_ijazah; ?>" required>
															</div>
															<div class="form-group">
																<label>Jumlah Program Study</label>
																<input class="form-control form-control-lg" type="text" name="jumlah_program_study" value="<?php echo $Guru->jumlah_program_study; ?>" required>
															</div>
															<div class="form-group">
																<label>Tingkatan</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" name="tingkatan" required>
																	<option value="SD" <?php if($Guru->tingkatan == 'SD'): ?> selected <?php endif; ?>>SD</option>
																	<option value="SMP" <?php if($Guru->tingkatan == 'SMP'): ?> selected <?php endif; ?> >SMP</option>
																	<option value="SMA" <?php if($Guru->tingkatan == 'SMA'): ?> selected <?php endif; ?> >SMA</option>
																</select>
															</div>
															<div class="form-group">
																<label>Status Perkawinan</label>
																<select class="selectpicker form-control form-control-lg" data-style="btn-outline-secondary btn-lg" title="Not Chosen" name="status_perkawinan" required>
																	<option value="belum menikah" <?php if($Guru->status_perkawinan == 'belum menikah'): ?> selected <?php endif; ?>>Belum Menikah</option>
																	<option value="menikah" <?php if($Guru->status_perkawinan == 'menikah'): ?> selected <?php endif; ?> >Menikah</option>
																</select>
															</div>
															<div class="form-group">
																<label>Tanggal Mulai Bertugas</label>
																<input class="form-control form-control-lg" type="date" name="tanggal_mulai_bertugas" value="<?php echo $Guru->tanggal_mulai_bertugas; ?>" required>
															</div>
															<div class="form-group mb-0">
																<!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
																<button type="submit" class="btn btn-success">Simpan</button>
															</div>
														</li>
														<li class="weight-500 col-md-6">
															<h4 class="text-blue h5 mb-20">Edit Lampiran</h4>
															<div class="form-group">
																<label>FC Ijazah : </label><br/>
																<?php if($Guru->fc_ijazah != ''): ?>
																	<a href="upload/<?php echo $Guru->fc_ijazah; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="fc_ijazah">
															</div>
															<div class="form-group">
																<label>Fc Sk Sekolah:</label><br/>
																<?php if($Guru->fc_sk_sekolah != ''): ?>
																	<a href="upload/<?php echo $Guru->fc_sk_sekolah; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="fc_sk_sekolah" accept="image/*">
															</div>
															<div class="form-group">
																<label>FC Sk Gtt:</label><br/>
																<?php if($Guru->fc_sk_gtt != ''): ?>
																	<a href="upload/<?php echo $Guru->fc_sk_gtt; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="fc_sk_gtt" accept="image/*">
															</div>
															<div class="form-group">
																<label>FC Kartu Anggota Muhammadiyah:</label><br/>
																<?php if($Guru->fc_kartu_anggota_muhammadiyah != ''): ?>
																	<a href="upload/<?php echo $Guru->fc_kartu_anggota_muhammadiyah; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="fc_kartu_anggota_muhammadiyah" accept="image/*">
															</div>
															<div class="form-group">
																<label>FC Kartu Keluarga:</label><br/>
																<?php if($Guru->fc_kartu_keluarga != ''): ?>
																	<a href="upload/<?php echo $Guru->fc_kartu_keluarga; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="fc_kartu_keluarga" accept="image/*">
															</div>
															<div class="form-group">
																<label>Sk Membaca Al Quran:</label><br/>
																<?php if($Guru->sk_membaca_alquran != ''): ?>
																	<a href="upload/<?php echo $Guru->sk_membaca_alquran; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="sk_membaca_alquran" accept="image/*">
															</div>
															<div class="form-group">
																<label>Sk Aktif Kegiatan Muhammadiyah:</label><br/>
																<?php if($Guru->sk_aktif_kegiatan_muhammadiyah != ''): ?>
																	<a href="upload/<?php echo $Guru->sk_aktif_kegiatan_muhammadiyah; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="sk_aktif_kegiatan_muhammadiyah" accept="image/*">
															</div>
															<div class="form-group">
																<label>Sk Pernyataan Ketentuan Dikdasmen:</label><br/>
																<?php if($Guru->sk_pernyataan_ketentuan_dikdasmen != ''): ?>
																	<a href="upload/<?php echo $Guru->sk_pernyataan_ketentuan_dikdasmen; ?>" target="_blank" style="color:red;">Lihat File Terupload</a>
																<?php endif; ?>
																<input type="file" class="form-control form-control-lg" name="sk_pernyataan_ketentuan_dikdasmen" accept="image/*">
															</div>
															<div class="form-group mb-0">
																<!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
															</div>
														</li>
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->
									</div>
								</div>
							</div>
						</div>
					</div>
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
	<script src="src/plugins/cropperjs/dist/cropper.js"></script>
	<script>
		window.addEventListener('DOMContentLoaded', function () {
			var image = document.getElementById('image');
			var cropBoxData;
			var canvasData;
			var cropper;

			$('#modal').on('shown.bs.modal', function () {
				cropper = new Cropper(image, {
					autoCropArea: 0.5,
					dragMode: 'move',
					aspectRatio: 3 / 3,
					restore: false,
					guides: false,
					center: false,
					highlight: false,
					cropBoxMovable: false,
					cropBoxResizable: false,
					toggleDragModeOnDblclick: false,
					ready: function () {
						cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
					}
				});
			}).on('hidden.bs.modal', function () {
				cropBoxData = cropper.getCropBoxData();
				canvasData = cropper.getCanvasData();
				cropper.destroy();
			});
		});
	</script>
</body>
</html>