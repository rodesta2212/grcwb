<?php

    include("config.php");
    include_once('includes/pelatihan.inc.php');

    session_start();
    if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Pelatihan = new Pelatihan($db);
    $Pelatihan->id_pelatihan = $id;

    if($Pelatihan->delete()){
        echo "<script>location.href='pelatihan.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='pelatihan.php';</script>";
    }

?>
