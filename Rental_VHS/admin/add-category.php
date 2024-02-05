<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['create'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $sql = "INSERT INTO  tblcategory(CategoryName,Status) VALUES(:category,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "Catégorie ajouté";
            header('location:manage-categories.php');
        } else {
            $_SESSION['error'] = "Quelque chose s'est mal passé";
            header('location:manage-categories.php');
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
        <title>Online RENTAL | Add Categories</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLE  -->
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
                        <h4 class="header-line">AJOUTER UNE CATÉGORIE</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Formulaire d'ajout de catégorie
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Nom de la Catégorie</label>
                                        <input class="form-control" type="text" name="category" autocomplete="off"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label>Statut</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" id="status" value="1"
                                                    checked="checked">Actif
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="status" id="status" value="0">Inactif
                                            </label>
                                        </div>

                                    </div>
                                    <button type="submit" name="create" class="btn btn-info">CRÉER </button>
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

<!-- Add-category ADMIN -->