<?php
    include("config.php");

	session_start();
	if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();
?>

<?php
	if($_POST){
		// post
		$tgl_mulai = $_POST["tgl_mulai"];
        $tgl_selesai = $_POST["tgl_selesai"];

		echo "<script>location.href='laporan.php?tgl_mulai=".$tgl_mulai."&&tgl_selesai=".$tgl_selesai."'</script>";
	}
?>