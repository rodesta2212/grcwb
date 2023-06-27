<!DOCTYPE html>
<html lang="en">

<?php
    include("config.php");
    include_once('includes/pelatihan.inc.php');
    include_once('includes/program.inc.php');

    $config = new Config(); $db = $config->getConnection();

	$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

	$Pelatihan = new Pelatihan($db);
	$Pelatihan->id_pelatihan = $id;
	$Pelatihan->readOne();
    $Program = new Program($db);
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
						   <h2><?php echo $Pelatihan->nama; ?></h2>
                        </div>
						<div class="full">
						  <p>
                            <?php echo $Pelatihan->deskripsi; ?>
                          </p>
						</div>
                        <div class="full">
                            <h4>
                                Pelaksanaan : 
                                <?php 
									$date_mulai = strtotime($Pelatihan->tgl_mulai);
									$date_selesai = strtotime($Pelatihan->tgl_selesai); 
								?>
								<?=date('d M Y', $date_mulai);?> - <?=date('d M Y', $date_selesai);?>
                            </h4>
						</div>
						<!-- <div class="full">
						   <a class="hvr-radial-out button-theme" href="#">Join</a>
						</div> -->
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="full">
                        <img src="upload/<?php echo $Pelatihan->gambar; ?>" alt="#" />
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- end section -->
	<!-- section -->
    <div class="section layout_padding padding_bottom-0">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="full">
                        <div class="heading_main text_align_center">
						   <h2><span>Program</span></h2>
                        </div>
					  </div>
                </div>
                <?php $Programs = $Program->readActive(); while ($row = $Programs->fetch(PDO::FETCH_ASSOC)) : ?>
                    <div class="col-md-3">
                        <a href="program-detail.php?id=<?php echo $row['id_program']; ?>">
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