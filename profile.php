<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/peserta.inc.php');
    include_once("includes/user.inc.php");

	session_start();
	if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
	$id_user = isset($_GET['id_user']) ? $_GET['id_user'] : die('ERROR: missing ID.');

	$Peserta = new Peserta($db);
	$Peserta->id_peserta = $id;
	$Peserta->readOne();

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
		// upload file
		if(isset($_FILES['foto'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['foto']['name']);
			$file_size =$_FILES['foto']['size'];
			$file_tmp =$_FILES['foto']['tmp_name'];
			$file_type=$_FILES['foto']['type'];
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
			// post peserta
			$Peserta->id_peserta = $_POST["id_peserta"];
			$Peserta->nama = $_POST["nama"];
			$Peserta->tgl_lahir = $_POST["tgl_lahir"];
			$Peserta->jenis_kelamin = $_POST["jenis_kelamin"];
			$Peserta->telp = $_POST["telp"];
			$Peserta->email = $_POST["email"];
			$Peserta->alamat = $_POST["alamat"];
			$Peserta->id_user = $_POST["id_user"];

			// post name img
			if (!empty($_FILES['foto']['name'])){
				$Peserta->foto = $_FILES['foto']['name'];
			} else{
				$Peserta->foto = $Peserta->foto;
			}

			// post user
			$User->id_user = $_POST["id_user"];
			$User->username = $_POST["username"];
			$User->password = $_POST["password"];
			$User->role = $_POST["role"];

			if ($Peserta->update() && $User->update()) {
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
							<div class="profile-photo">
								<!-- <a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a> -->
								<img class="avatar-photo" src="upload/<?=$_SESSION['foto']?>" alt="profile">
								<!-- <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
								</div> -->
							</div>
							<h5 class="text-center h5 mb-0"><?php echo ucwords($Peserta->nama); ?></h5>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email :</span>
										<?php echo $Peserta->email; ?>
									</li>
									<li>
										<span>No Telp :</span>
										+62<?php echo $Peserta->telp; ?>
									</li>
									<li>
										<span>Alamat :</span>
										<?php echo $Peserta->alamat; ?>
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
												<input type="hidden" name="id_peserta" value="<?php echo $Peserta->id_peserta; ?>">
												<input type="hidden" name="id_user" value="<?php echo $User->id_user; ?>">
												<input type="hidden" name="username" value="<?php echo $User->username; ?>">
												<input type="hidden" name="password" value="<?php echo $User->password; ?>">
												<input type="hidden" name="role" value="<?php echo $User->role; ?>">
												<!-- hidden -->
													<ul class="profile-edit-list">
														<li class="weight-500">
															<h4 class="text-blue h5 mb-20">Edit Profil</h4>
															<div class="form-group">
																<label>Nama Lengkap</label>
																<input class="form-control form-control-lg" type="text" name="nama" value="<?php echo $Peserta->nama; ?>" required>
															</div>
															<div class="form-group">
																<label>Email</label>
																<input class="form-control form-control-lg" type="email" name="email" value="<?php echo $Peserta->email; ?>" required>
															</div>
															<div class="form-group">
																<label>Tanggal Lahir</label>
																<input class="form-control form-control-lg" type="date" name="tgl_lahir" value="<?php echo $Peserta->tgl_lahir; ?>" required>
															</div>
															<div class="form-group">
																<label>Jenis Kelamin</label>
																<div class="d-flex">
																	<?php if($Peserta->jenis_kelamin == 'laki'): ?>
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
															<div class="form-group row">
																<label class="col-sm-12 col-form-label">No Telpon</label>
																<div class="col-2" style="padding-right:5px;">
																	<input class="form-control" type="text" value="+62" readonly>
																</div>
																<div class="col-10" style="padding-left:0px;">
																	<input class="form-control" type="number" min="0" name="telp" value="<?php echo $Peserta->telp; ?>" required>
																</div>
															</div>
															<div class="form-group">
																<label>Alamat</label>
																<textarea class="form-control" name="alamat" required><?php echo $Peserta->alamat; ?></textarea>
															</div>
															<div class="form-group">
																<label>Foto</label> 
																<input type="file" class="form-control" name="foto">
															</div>
															<div class="form-group mb-0">
																<!-- <input type="submit" class="btn btn-primary" value="Simpan"> -->
																<button type="submit" class="btn btn-success">Simpan</button>
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