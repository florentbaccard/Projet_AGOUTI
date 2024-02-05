<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $diffid = intval($_GET['diffid']);
        $diffuser = $_POST['diffuser'];
        $sql = "update  tbldiffusers set DiffuserName=:diffuser where id=:diffid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':diffuser', $diffuser, PDO::PARAM_STR);
        $query->bindParam(':diffid', $diffid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "Diffuser info updated successfully";
        header('location:manage-diffusers.php');
    }
?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Edit Diffuser</title>
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

    </head>

    <body>

        <!-- Inclusion du menu -->
        <?php include('includes/header.php'); ?>

        <div class="content-wrapper">
            <div class="container">
                <div class="row pad-botm">
                    <div class="col-md-12">
                        <h4 class="header-line">Édition d'un Diffuseur</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Information du Diffuseur
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Nom du Diffuseur</label>
                                        <?php
                                        $diffid = intval($_GET['diffid']);
                                        $sql = "SELECT * from  tbldiffusers where id=:diffid";
                                        $query = $dbh->prepare($sql);
                                        $query->bindParam(':diffid', $diffid, PDO::PARAM_STR);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <input class="form-control" type="text" name="diffuser" value="<?php echo htmlentities($result->DiffuserName); ?>" required />
                                        <?php }
                                        } ?>
                                    </div>

                                    <button type="submit" name="update" class="btn btn-info">METTRE À JOUR </button>
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

<!-- Edit-diffuser.php ADMIN -->