<!DOCTYPE html>
<html>

<?php
    include("config.php");
    include_once('includes/program.inc.php');

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

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

			if($Program->insert()){
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
						<h4 class="text-blue h4"><i class="dw dw-edit-file"></i> Data Program</h4>
						<!-- <p class="mb-0">you can find more options <a class="text-primary" href="https://datatables.net/" target="_blank">Click Here</a></p> -->
                    </div>
                    <div style="padding-right:15px;">
                        <!-- <a href="program-create"> -->
                            <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#createModal">Tambah</button>
                        <!-- </a> -->
                    </div>
                    <div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr class="text-center">
									<th>No</th>
									<th>Nama Program</th>
                                    <!-- <th>Deskripsi</th> -->
                                    <th>Biaya</th>
									<th>Jam</th>
									<th>Gambar</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
                                <?php $no=1; $Programs = $Program->readAll(); while ($row = $Programs->fetch(PDO::FETCH_ASSOC)) : ?>
								<tr class="text-center">
									<td><?=$no?></td>
									<td><?=ucwords($row['nama'])?></td>
									<!-- <td><?=$row['deskripsi']?></td> -->
									<td>Rp. <?=number_format($row['biaya'],0,',','.')?></td>
									<!-- date format -->
									<?php 
										$time_mulai = strtotime($row['jam_mulai']);
										$time_selesai = strtotime($row['jam_selesai']); 
									?>
									<!-- date format -->
                                    <td>
										<?=date('H:i', $time_mulai);?> - <?=date('H:i', $time_selesai);?>
									</td>
									<td>
										<img src="upload/<?=$row['gambar']?>" alt="<?=$row['gambar']?>" style="width:70px;">
									</td>
									<td>
                                        <!-- <a class="dropdown-item link-action" href="program-detail.php?id=<?php echo $row['id_program']; ?>"><i class="dw dw-eye"></i> Detail</a> |  -->
										<a class="dropdown-item link-action" href="program-update.php?id=<?php echo $row['id_program']; ?>" data-color="#265ed7"><i class="dw dw-edit-1"></i> Update</a> | 
										<a class="dropdown-item link-action" href="program-delete.php?id=<?php echo $row['id_program']; ?>" data-color="#e95959"><i class="dw dw-delete-3"></i> Delete</a>
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
                                    <h4 class="modal-title">Tambah Program</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <!-- hidden form -->
									<input type="hidden" name="id_program" value="<?php echo $Program->getNewId(); ?>">
									<!-- hidden form -->
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Nama program<span style="color:red;">*</span></label>
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
										<label class="col-sm-4 col-form-label">Biaya<span style="color:red;">*</span></label>
										<div class="col-2" style="padding-right:5px;">
											<input class="form-control" type="text" value="Rp." readonly>
										</div>
										<div class="col-6" style="padding-left:0px;">
											<input class="form-control" type="number" min="0" name="biaya" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Jam Mulai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="time" class="form-control" name="jam_mulai" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-4 col-form-label">Jam Selesai<span style="color:red;">*</span></label>
										<div class="col-sm-8">
											<input type="time" class="form-control" name="jam_selesai" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-form-label">Hari<span style="color:red;">*</span></label>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck1-1" name="senin" value="YES">
											<label class="custom-control-label" for="customCheck1-1">Senin</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck2-1" name="jumat" value="YES">
											<label class="custom-control-label" for="customCheck2-1">Jum'at</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck3-1" name="selasa" value="YES">
											<label class="custom-control-label" for="customCheck3-1">Selasa</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck4-1" name="sabtu" value="YES">
											<label class="custom-control-label" for="customCheck4-1">Sabtu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck5-1" name="rabu" value="YES">
											<label class="custom-control-label" for="customCheck5-1">Rabu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck6-1" name="minggu" value="YES">
											<label class="custom-control-label" for="customCheck6-1">Minggu</label>
										</div>
										<div class="custom-control custom-checkbox mb-5 col-sm-6" style="padding-left: 45px;">
											<input type="checkbox" class="custom-control-input" id="customCheck7-1" name="kamis" value="YES">
											<label class="custom-control-label" for="customCheck7-1">Kamis</label>
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
