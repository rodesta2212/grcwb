<!DOCTYPE html>
<html lang="en">

<?php
    include("config.php");
    include_once('includes/pelatihan.inc.php');
    include_once('includes/program.inc.php');
    include_once('includes/testimoni.inc.php');

    $config = new Config(); $db = $config->getConnection();
	$Pelatihan = new Pelatihan($db);
    $Program = new Program($db);
    $Testimoni = new Testimoni($db);
?>

<!-- Basic -->
<!-- head -->
<?php include("index-head.php"); ?>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- header -->
    <?php include("index-header.php"); ?>

    <!-- Start Banner -->
    <div class="ulockd-home-slider">
        <div class="container-fluid">
            <div class="row">
                <div class="pogoSlider" id="js-main-slider">
                    <div class="pogoSlider-slide" style="background-image:url(images/banner_img.png);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slide_text">
                                        <h3><span span class="theme_color">You only have know one thing</span><br>you can learn anything</h3>
                                        <h4>Courses by Wabi</h4>
                                        <br>
                                        <div class="full center">
                                            <a class="contact_bt" href="register.php">Start a Course</a>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pogoSlider-slide" style="background-image:url(images/banner_img.png);">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slide_text">
                                        <h3><span span class="theme_color">You only have know one thing</span><br>you can learn anything</h3>
                                        <h4>Courses by Wabi</h4>
                                        <br>
                                        <div class="full center">
										    <a class="contact_bt" href="register.php">Start a Course</a>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- .pogoSlider -->
            </div>
        </div>
    </div>
    <!-- End Banner -->
    <!-- section -->
	<div class="section tabbar_menu">
	   <div class="container">
	      <div class="row">
		      <div class="col-md-12">
			     <div class="tab_menu">
				    <ul>
					   <li><a href="#"><span class="icon"><img src="images/i1.png" alt="#" /></span><span>University Life</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i2.png" alt="#" /></span><span>Graduation</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i3.png" alt="#" /></span><span>Athletics</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i4.png" alt="#" /></span><span>Social</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i5.png" alt="#" /></span><span>Location</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i6.png" alt="#" /></span><span>Call us</span></a></li>
					   <li><a href="#"><span class="icon"><img src="images/i7.png" alt="#" /></span><span>Email</span></a></li>
					</ul>
				 </div>
			  </div>
		  </div>
	   </div>
	</div>
	<!-- end section -->
	<!-- section -->
    <div class="section margin-top_50">
        <div class="container">
            <div class="row">
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2><span>Welcome To</span><span style="color:#d4a81e;"> Wabi</span></h2>
                        </div>
						<div class="full">
						  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
						  Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
						  Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
						</div>
						<!-- <div class="full">
						   <a class="hvr-radial-out button-theme" href="#">About more</a>
						</div> -->
                    </div>
                </div>
				<div class="col-md-6">
                    <div class="full">
                        <img src="images/wabi2.png" alt="#" style="height: 400px; width: 400px;"/>
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
                <?php $Pelatihans = $Pelatihan->readAll(); while ($row = $Pelatihans->fetch(PDO::FETCH_ASSOC)) : ?>
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
	<!-- section -->
    <div class="section margin-top_50 silver_bg">
        <div class="container">
            <div class="row">
			    <div class="col-md-6">
                    <div class="full float-right_img">
                        <img src="images/img6.png" alt="#" />
                    </div>
                </div>
                <div class="col-md-6 layout_padding_2">
                    <div class="full">
                        <div class="heading_main text_align_left">
						   <h2><span>Register For Join Course</h2>
                        </div>
						<div class="full">
						  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor 
						  in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
						  sunt in culpa qui officia deserunt mollit anim id est laborum</p>
						</div>
						<div class="full">
						   <a class="hvr-radial-out button-theme" href="register.php">Register</a>
						</div>
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

    <!-- section -->
    <div class="section layout_padding padding_bottom-0">
        <div class="container">
                    <div id="testimonial-slider" class="owl-carousel">
                        <?php $i=0; $Testimonis = $Testimoni->readIndex(); while ($row = $Testimonis->fetch(PDO::FETCH_ASSOC)) : ?>
                            <div class="testimonial row">
                                <div class="col-2">
                                    <img src="upload/<?=$row['foto']?>" alt="#" style="width:110px; height:110px; border-radius:50%;" />
                                </div>
                                <div class="col-10">
                                <p class="description">
                                    <?=$row['testimoni']?>
                                </p>
                                <h3 class="title"><?=$row['nama_peserta']?></h3>
                                <small class="post">- <?=$row['nama_pelatihan']?></small>
                        </div>
                            </div>
                        <?php $i++; endwhile; ?>
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