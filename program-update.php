<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/program.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Program = new Program($db);
	$Program->id_program = $id;
	$Program->readOne();
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
		if(isset($_FILES['gambar'])){
			$errors= array();
			$file_name = str_replace(" ", "-", $_FILES['gambar']['name']);
			$file_size =$_FILES['gambar']['size'];
			$file_tmp =$_FILES['gambar']['tmp_name'];
			$file_type=$_FILES['gambar']['type'];
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
			$Program->id_program = $_POST["id_program"];
            $Program->nama = $_POST["nama"];
            $Program->deskripsi = $_POST["deskripsi"];
            $Program->jam_mulai = $_POST["jam_mulai"];
			$Program->jam_selesai = $_POST["jam_selesai"];
			$Program->biaya = $_POST["biaya"];
			$Program->senin = isset ($_POST['senin']) ? $_POST['senin']:'NOT';
			$Program->selasa = isset ($_POST['selasa']) ? $_POST['selasa']:'NOT';
			$Program->rabu = isset ($_POST['rabu']) ? $_POST['rabu']:'NOT';
			$Program->kamis = isset ($_POST['kamis']) ? $_POST['kamis']:'NOT';
			$Program->jumat = isset ($_POST['jumat']) ? $_POST['jumat']:'NOT';
			$Program->sabtu = isset ($_POST['sabtu']) ? $_POST['sabtu']:'NOT';
			$Program->minggu = isset ($_POST['minggu']) ? $_POST['minggu']:'NOT';

			// post name img
			if (!empty($_FILES['gambar']['name'])){
				$Program->gambar = $_FILES['gambar']['name'];
			}

			if ($Program->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='program.php'</script>";
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
						<h4 class="text-blue h4"><i class="dw dw-edit-1"></i> Update Data</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
					<form method="POST" enctype="multipart/form-data">
						<div style="padding-right:15px;">
                            <button type="submit" class="btn btn-success float-right">Simpan</button>
                        </div>
                        <!-- hidden -->
                        <input type="hidden" name="id_program" value="<?php echo $Program->id_program; ?>">
                        <!-- hidden -->
                        <!-- horizontal Basic Forms Start -->
                        <div class="pd-20 mb-30">
                            <div class="form-group">
                                <label>Nama Program</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $Program->nama; ?>">
                            </div>
							<div class="form-group">
								<label>Deskripsi</label>
								<textarea class="form-control" name="deskripsi" style="height:150px;"><?php echo $Program->deskripsi; ?></textarea>
							</div>
							<div class="form-group row">
                                <label class="col-12">Biaya</label>
                                <div class="col-3 col-md-1" style="padding-right:5px;">
									<input class="form-control" type="text" value="Rp." readonly>
								</div>
								<div class="col-9 col-md-11" style="padding-left:0px;">
									<input class="form-control" type="number" min="0" name="biaya" value="<?php echo $Program->biaya; ?>">
								</div>
                            </div>
							<div class="form-group">
								<label>Jam Mulai</label>
								<input type="time" class="form-control" name="jam_mulai" value="<?php echo $Program->jam_mulai; ?>">
							</div>
							<div class="form-group">
								<label>Jam Selesai</label>
								<input type="time" class="form-control" name="jam_selesai" value="<?php echo $Program->jam_selesai; ?>">
							</div>
							<div class="form-group">
								<label>Hari</label>
							</div>
							<div class="row" style="margin-left: 0px !important;">
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck1-1" name="senin" value="YES" <?php if($Program->senin == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck1-1">Senin</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck2-1" name="jumat" value="YES" <?php if($Program->jumat == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck2-1">Jum'at</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck3-1" name="selasa" value="YES" <?php if($Program->selasa == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck3-1">Selasa</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck4-1" name="sabtu" value="YES" <?php if($Program->sabtu == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck4-1">Sabtu</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck5-1" name="rabu" value="YES" <?php if($Program->rabu == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck5-1">Rabu</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck6-1" name="minggu" value="YES" <?php if($Program->minggu == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck6-1">Minggu</label>
								</div>
								<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
									<input type="checkbox" class="custom-control-input" id="customCheck7-1" name="kamis" value="YES" <?php if($Program->kamis == 'YES'): ?> checked="checked" <?php endif; ?>>
									<label class="custom-control-label" for="customCheck7-1">Kamis</label>
								</div>
							</div>
							<div class="form-group">
                                <label>Gambar <span><a href="#" onclick="showHide()"><i class="icon dw dw-exchange" style="color:#FF0000; border-radius: 99em; border: 1px solid #FF0000; box-shadow: 1px 1px 1px 4px rgb(255, 255, 255); padding: 4px;"></i></a></span></label> 
                                <input id="file_upload" type="file" class="form-control" name="gambar" style="display:none;">
								<br/>
								<img id="file_img" src="upload/<?php echo $Program->gambar; ?>" alt="<?php echo $Program->gambar; ?>" style="width:200px;">
                            </div>
                        </div>
					</form>
				</div>
				<!-- Simple Datatable End -->
			</div>
            <!-- footer -->
            <?php include("footer.php"); ?>
		</div>
	</div>
	<!-- js -->
    <?php include("script.php"); ?>
	<script>
		function showHide() {
			var upload = document.getElementById("file_upload");
			var img = document.getElementById("file_img");
			if (img.style.display === "none") {
				img.style.display = "block";
			} else {
				img.style.display = "none";
			}
			if (upload.style.display === "block") {
				upload.style.display = "none";
			} else {
				upload.style.display = "block";
			}
		}
	</script>
</body>
</html>
