<!DOCTYPE html>
<html lang="en">

<?php
    include("config.php");
    include_once('includes/program.inc.php');
    include_once('includes/pelatihan.inc.php');

    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Program = new Program($db);
	$Program->id_program = $id;
	$Program->readOne();
    $Pelatihan = new Pelatihan($db);
?>

<!-- Basic -->
<!-- head -->
<?php include("index-head.php"); ?>

<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- header -->
	<?php include("index-header.php"); ?>

	<!-- section -->
	
	<!-- <section class="inner_banner">
	  <div class="container">
	      <div class="row">
		      <div class="col-12">
			     <div class="full">
				     <h3>About us</h3>
				 </div>
			  </div>
		  </div>
	  </div>
	</section> -->
	
	<!-- end section -->
   
	<!-- section -->
    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2><?php echo $Program->nama; ?></h2>
                        </div>
						<div class="full">
						  <p>
                            <?php echo $Program->deskripsi; ?>
                          </p>
						</div>
                        <div class="full">
						   <h4>Biaya : Rp. <?=number_format($Program->biaya,0,',','.')?></h4>
						</div>
                        <div class="full">
                            <h4>
                                Pelaksanaan : 
                                <?php 
									$time_mulai = strtotime($Program->jam_mulai);
                                    $time_selesai = strtotime($Program->jam_selesai); 
								?>
								<?=date('H:i', $time_mulai);?> - <?=date('H:i', $time_selesai);?> WIB
                            </h4>
						</div>
						<div class="row" style="margin-left: 0px !important;">
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck1-1" disabled="disabled" <?php if($Program->senin == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck1-1">Senin</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck2-1" disabled="disabled" <?php if($Program->jumat == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck2-1">Jum'at</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck3-1" disabled="disabled" <?php if($Program->selasa == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck3-1">Selasa</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck4-1" disabled="disabled" <?php if($Program->sabtu == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck4-1">Sabtu</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck5-1" disabled="disabled" <?php if($Program->rabu == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck5-1">Rabu</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck6-1" disabled="disabled" <?php if($Program->minggu == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck6-1">Minggu</label>
							</div>
							<div class="custom-control custom-checkbox mb-5 col-sm-6" style="margin-bottom: 15px !important;">
								<input type="checkbox" class="custom-control-input" id="customCheck7-1" disabled="disabled" <?php if($Program->kamis == 'YES'): ?> checked="checked" <?php endif; ?>>
								<label class="custom-control-label" for="customCheck7-1">Kamis</label>
							</div>
						</div>
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="full">
                        <img src="upload/<?php echo $Program->gambar; ?>" alt="#" />
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- end section -->
	<!-- section -->
    <div class="section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
						   <h2><span>Courses</span></h2>
                        </div>
					  </div>
                </div>
                <?php $Pelatihans = $Pelatihan->readActive(); while ($row = $Pelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="col-md-4">
                        <a href="courses-detail.php?id=<?php echo $row['id_pelatihan']; ?>">
                            <div class="full blog_img_popular">
                                <img class="img-responsive" src="upload/<?=$row['gambar']?>" alt="#" /> 
                                <h4><?=ucwords($row['nama'])?></h4>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
	<!-- end section -->

	<!-- footer -->
    <?php include("index-footer.php"); ?>

    <!-- script -->
    <?php include("index-script.php"); ?>
</body>

</html>