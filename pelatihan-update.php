<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

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
				$errors[]="extension not allowed, please choose a JPEG, JPG, PNG, or PDF file.";
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
			$Pelatihan->id_pelatihan = $_POST["id_pelatihan"];
            $Pelatihan->nama = $_POST["nama"];
            $Pelatihan->deskripsi = $_POST["deskripsi"];
            $Pelatihan->tgl_mulai = $_POST["tgl_mulai"];
			$Pelatihan->tgl_selesai = $_POST["tgl_selesai"];

			// post name img
			if (!empty($_FILES['gambar']['name'])){
				$Pelatihan->gambar = $_FILES['gambar']['name'];
			} else{
				$Pelatihan->gambar = $Pelatihan->gambar;
			}

			if ($Pelatihan->update()) {
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
				echo '</script>';
				echo "<script>location.href='pelatihan.php'</script>";
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
                        <input type="hidden" name="id_pelatihan" value="<?php echo $Pelatihan->id_pelatihan; ?>">
                        <!-- hidden -->
                        <!-- horizontal Basic Forms Start -->
                        <div class="pd-20 mb-30">
                            <div class="form-group">
                                <label>Nama Pelatihan</label>
                                <input type="text" class="form-control" name="nama" value="<?php echo $Pelatihan->nama; ?>">
                            </div>
							<div class="form-group">
								<label>Deskripsi</label>
								<textarea class="form-control" name="deskripsi" style="height:150px;"><?php echo $Pelatihan->deskripsi; ?></textarea>
							</div>
							<div class="form-group">
								<label>Tanggal Mulai</label>
								<input type="date" class="form-control" name="tgl_mulai" value="<?php echo $Pelatihan->tgl_mulai; ?>">
							</div>
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<input type="date" class="form-control" name="tgl_selesai" value="<?php echo $Pelatihan->tgl_selesai; ?>">
							</div>
							<div class="form-group">
                                <label>Gambar <span><a href="#" onclick="showHide()"><i class="icon dw dw-exchange" style="color:#FF0000; border-radius: 99em; border: 1px solid #FF0000; box-shadow: 1px 1px 1px 4px rgb(255, 255, 255); padding: 4px;"></i></a></span></label> 
                                <input id="file_upload" type="file" class="form-control" name="gambar" style="display:none;">
								<br/>
								<img id="file_img" src="upload/<?php echo $Pelatihan->gambar; ?>" alt="<?php echo $Pelatihan->gambar; ?>" style="width:200px;">
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
