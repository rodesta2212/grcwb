<?php
    include("config.php");

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();
?>

<?php
	if($_POST){
		// post
		$id_pelatihan = $_POST["id_pelatihan"];

		echo "<script>location.href='laporan-peserta.php?id_pelatihan=".$id_pelatihan."'</script>";
	}
?>