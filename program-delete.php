<?php

    include("config.php");
    include_once('includes/program.inc.php');

    session_start();
    if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Program = new Program($db);
    $Program->id_program = $id;

    if($Program->delete()){
        echo "<script>location.href='program.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='program.php';</script>";
    }

?>
