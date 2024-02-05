<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['issue'])) {
        $renterid = strtoupper($_POST['renterid']);
        $vhsid = $_POST['vhsdetails'];
        $sql = "INSERT INTO  tblissuedvhsdetails(RenterID,VhsId) VALUES(:renterid,:vhsid)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':renterid', $renterid, PDO::PARAM_STR);
        $query->bindParam(':vhsid', $vhsid, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "VHS récupéré";
            header('location:manage-issued-vhs.php');
        } else {
            $_SESSION['error'] = "Quelque chose s'est mal passé";
            header('location:manage-issued-vhs.php');
        }
    }
    ?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Issue VHS</title>
        <!-- BOOTSTRAP CORE STYLE -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <!-- GOOGLE FONT -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <!-- FAVICON -->
        <link rel="icon" href="assets/img/favicon.png">

        <!-- Script -->
        <script>
            // Fonction pour avoir l'id du loueur
            function getrenter() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_renter.php",
                    data: 'renterid=' + $("#renterid").val(),
                    type: "POST",
                    success: function (data) {
                        $("#get_renter_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () { }
                });
            }

            // Fonction pour avoir les informations des vhs
            function getvhs() {
                $("#loaderIcon").show();
                jQuery.ajax({
                    url: "get_vhs.php",
                    data: 'vhsid=' + $("#vhsid").val(),
                    type: "POST",
                    success: function (data) {
                        $("#get_vhs_name").html(data);
                        $("#loaderIcon").hide();
                    },
                    error: function () { }
                });
            }
        </script>

        <!-- Style -->
        <style type="text/css">
            .others {
                color: red;
            }
        </style>

    </head>

    <body>

        <!-- Inclusion du menu -->
        <?php include('includes/header.php'); ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Ajouter un Emprunt</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Formulaire d'ajout d'un emprunt
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">

                                    <div class="form-group">
                                        <label>Identifiant Loueur<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="renterid" id="renterid"
                                            onBlur="getrenter()" autocomplete="off" required />
                                    </div>

                                    <div class="form-group">
                                        <span id="get_renter_name" style="font-size:16px;"></span>
                                    </div>

                                    <div class="form-group">
                                        <label>EAN<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="vhskid" id="vhsid" onBlur="getvhs()"
                                            required="required" />
                                    </div>

                                    <div class="form-group">

                                        <select class="form-control" name="vhsdetails" id="get_vhs_name" readonly>

                                        </select>
                                    </div>
                                    <button type="submit" name="issue" id="submit" class="btn btn-info">AJOUTER L'EMPRUNT
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- Inclusion du Footer -->
        <?php include('includes/footer.php'); ?>

        <!-- Script -->
        <script src="assets/js/jquery-3.7.0.js"></script>
        <script src="assets/js/bootstrap.js"></script>
        <script src="assets/js/custom.js"></script>

    </body>

    </html>

<?php } ?>

<!-- Issue-vhs.php ADMIN -->