<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['return'])) {
        $rid = intval($_GET['rid']);
        $fine = $_POST['fine'];
        $rstatus = 1;
        $sql = "update tblissuedvhsdetails set fine=:fine,ReturnStatus=:rstatus where id=:rid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':rid', $rid, PDO::PARAM_STR);
        $query->bindParam(':fine', $fine, PDO::PARAM_STR);
        $query->bindParam(':rstatus', $rstatus, PDO::PARAM_STR);
        $query->execute();

        $_SESSION['msg'] = "VHS récupéré";
        header('location:manage-issued-vhs.php');
    }
    ?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Update Issued VHS Details</title>
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

        <script>
            // Function pour trouver le Nom du Loueur
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

            // Function pour trouver les Informations de la VHS Emprunté
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
                        <h4 class="header-line">Détail du VHS Emprunté</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12 col-md-offset-1">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Information du VHS Emprunté
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <?php
                                    $rid = intval($_GET['rid']);
                                    $sql = "SELECT tblrenters.FullName, tblvhs.VHSName, tblvhs.EAN, tblissuedvhsdetails.IssuesDate, tblissuedvhsdetails.ReturnDate, tblissuedvhsdetails.id as rid, tblissuedvhsdetails.fine, tblissuedvhsdetails.ReturnStatus FROM tblissuedvhsdetails JOIN tblrenters ON tblrenters.RenterId=tblissuedvhsdetails.RenterId JOIN tblvhs ON tblvhs.id=tblissuedvhsdetails.VHSId WHERE tblissuedvhsdetails.id=:rid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':rid', $rid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>

                                            <!-- N/A utiliser pour indiquer l'absence d'information a la place de NULL-->

                                            <div class="form-group">
                                                <label>Nom du Loueur : </label>
                                                <?php echo htmlentities($result->FullName); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Nom du VHS : </label>
                                                <?php echo property_exists($result, 'VhsName') ? htmlentities($result->VhsName) : 'N/A'; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>EAN : </label>
                                                <?php echo isset($result->EAN) ? htmlentities($result->EAN) : 'N/A'; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Date d'Emprunt : </label>
                                                <?php echo isset($result->IssuesDate) ? htmlentities($result->IssuesDate) : 'N/A'; ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Statut du Retour : </label>
                                                <?php
                                                if (isset($result->ReturnDate) && $result->ReturnDate != "") {
                                                    echo htmlentities($result->ReturnDate);
                                                } else {
                                                    echo 'Not Return Yet';
                                                }
                                                ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Amende en € : </label>
                                                <?php
                                                if (isset($result->fine) && $result->fine != "") {
                                                    echo htmlentities($result->fine);
                                                } else { ?>
                                                    <input class="form-control" type="text" name="fine" id="fine" required />
                                                <?php } ?>
                                            </div>

                                            <?php if ($result->ReturnStatus == 0) { ?>

                                                <button type="submit" name="return" id="submit" class="btn btn-info">METTRE À JOUR
                                                </button>

                                        </div>

                                    <?php }
                                        }
                                    } ?>
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

<!-- Update-issuevhsdetails.php ADMIN -->