<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $category = $_POST['category'];
        $status = $_POST['status'];
        $catid = intval($_GET['catid']);
        $sql = "update  tblcategory set CategoryName=:category,Status=:status where id=:catid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':catid', $catid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['updatemsg'] = "Catégorie modifié";
        header('location:manage-categories.php');
    }
    ?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Edit Categories</title>
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
                        <h4 class="header-line">Édition d'une Catégorie</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Information Catégorie
                            </div>

                            <div class="panel-body">
                                <form role="form" method="post">
                                    <?php
                                    $catid = intval($_GET['catid']);
                                    $sql = "SELECT * from tblcategory where id=:catid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':catid', $catid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                            ?>
                                            <div class="form-group">
                                                <label>Nom de la Catégorie</label>
                                                <input class="form-control" type="text" name="category"
                                                    value="<?php echo htmlentities($result->CategoryName); ?>" required />
                                            </div>
                                            <div class="form-group">
                                                <label>Statut</label>
                                                <?php if ($result->Status == 1) { ?>
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
                                                <?php } else { ?>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="status" id="status" value="0"
                                                                checked="checked">Inactif
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="status" id="status" value="1">Actif
                                                        </label>
                                                    </div>
                                                <?php } ?>
                                            <?php }
                                    } ?>
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

<!-- Edit-category.php ADMIN -->