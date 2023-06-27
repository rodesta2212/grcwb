<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/pelatihan.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
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
			$Pelatihan->id_pelatihan = $_POST["id_pelatihan"];
            $Pelatihan->nama = $_POST["nama"];
            $Pelatihan->deskripsi = $_POST["deskripsi"];
            $Pelatihan->tgl_mulai = $_POST["tgl_mulai"];
			$Pelatihan->tgl_selesai = $_POST["tgl_selesai"];

			// post name img
			if (!empty($_FILES['gambar']['name'])){
				$Pelatihan->gambar = $_FILES['gambar']['name'];
			}

			if($Pelatihan->insert()){
				echo '<script language="javascript">';
                echo 'alert("Data Berhasil Terkirim")';
                echo '</script>';
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Data Pelatihan</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div style="padding-right:15px;">
                        <!-- <a href="pelatihan-create"> -->
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button>
                        <!-- </a> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama Pelatihan</th>
                                    <!-- <th>Deskripsi</th> -->
                                    <th>Tanggal</th>
									<th>Gambar</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $Pelatihans = $Pelatihan->readAll(); while ($row = $Pelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=ucwords($row['nama'])?></td>
									<!-- <td><?=$row['deskripsi']?></td> -->
									<!-- date format -->
									<?php 
										$date_mulai = strtotime($row['tgl_mulai']);
										$date_selesai = strtotime($row['tgl_selesai']); 
									?>
									<!-- date format -->
                                    <td>
										<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?>
									</td>
									<td>
										<img src="upload/<?=$row['gambar']?>" alt="<?=$row['gambar']?>" style="width:70px;">
									</td>
									<td>
                                        <!-- <a class="dropdown-item link-action" href="pelatihan-detail.php?id=<?php echo $row['id_pelatihan']; ?>"><i class="dw dw-eye"></i> Detail</a> |  -->
										<a class="dropdown-item link-action" href="pelatihan-update.php?id=<?php echo $row['id_pelatihan']; ?>" data-color="#265ed7"><i class="dw dw-edit-1"></i> Update</a> | 
										<a class="dropdown-item link-action" href="pelatihan-delete.php?id=<?php echo $row['id_pelatihan']; ?>" data-color="#e95959"><i class="dw dw-delete-3"></i> Delete</a>
									</td>
								</tr>
                                <?php $no++; endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple Datatable End -->

                <!-- Modal Create-->
                <div class="modal fade" id="createModal" role="dialog">
                    <div class="modal-dialog">
                        <form method="POST" enctype="multipart/form-data">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Pelatihan</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- hidden form -->
									<input type="hidden" name="id_pelatihan" value="<?php echo $Pelatihan->getNewId(); ?>">
									<!-- hidden form -->
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nama Pelatihan<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nama" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Deskripsi<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<textarea class="form-control" name="deskripsi" required style="height:100px;"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tanggal Mulai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="date" class="form-control" name="tgl_mulai" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Tanggal Selesai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="date" class="form-control" name="tgl_selesai" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Gambar<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="file" class="form-control" name="gambar" required>
										</div>
									</div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
