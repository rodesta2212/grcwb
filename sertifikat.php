<!DOCTYPE html>
<html>
    <?php
        include("config.php");
        include_once('includes/peserta.inc.php');

        session_start();
        if (!isset($_SESSION['id_user']) && $_SESSION['role'] != 'peserta') echo "<script>location.href='login.php'</script>";
        $config = new Config(); $db = $config->getConnection();

        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

        $Peserta = new Peserta($db);
        $Peserta->id_peserta = $id;
        $Peserta->readOne();
    ?>

    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8">
        <title>Course By Wabi</title>

        <!-- Site favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/sertifikat.css">
        <link rel="stylesheet" type="text/css" href="src/styles/w3.css">

    </head>
    <body>

        <center>
            <div id="printableArea" class="receipt">
                <div class="certificate-container">
                    <div class="certificate">
                        <div class="water-mark-overlay"></div>
                        <div class="certificate-header">
                            <img src="images/logowabi.png" class="logo" alt="logo">
                        </div>
                        <div class="certificate-body">
                            <p class="certificate-title"><strong>RENR NCLEX AND CONTINUING EDUCATION (CME) Review Masters</strong></p>
                            <h1>Certificate of Completion</h1>
                            <p class="student-name"><?=ucwords($Peserta->nama)?></p>
                            <div class="certificate-content">
                                <div class="about-certificate">
                                    <p>
                                has completed [hours] hours on topic title here online on Date [Date of Completion]
                                </p>
                                </div>
                                <p class="topic-title">
                                    The Topic consists of [hours] Continuity hours and includes the following:
                                </p>
                                <div class="text-center">
                                    <p class="topic-description text-muted">Contract adminitrator - Types of claim - Claim Strategy - Delay analysis - Thepreliminaries to a claim - The essential elements to a successful claim - Responses - Claim preparation and presentation </p>
                                </div>
                            </div>
                            <div class="certificate-footer text-muted">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Principal: ______________________</p>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p>
                                                    Accredited by
                                                </p>
                                            </div>
                                            <!-- <div class="col-md-6">
                                                <p>
                                                    Endorsed by
                                                </p>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-print w3-bar" style="margin-bottom:100px;">
                <a href="dashboard.php" class="w3-button w3-teal" style="margin-right:10px;">Kembali</a>
                <button class="w3-button w3-red" type="submit" onclick="printDiv('printableArea')">Print</button>
            </div>
        </center>

        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </body>
</html>