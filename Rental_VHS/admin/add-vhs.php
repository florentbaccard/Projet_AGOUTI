<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['add'])) {
        $vhsname = $_POST['vhsname'];
        $category = $_POST['category'];
        $diffuser = $_POST['diffuser'];
        $ean = $_POST['ean'];
        $price = $_POST['price'];
        $sql = "INSERT INTO  tblvhs(VHSName,CatId,DiffuserId,EAN,VHSPrice) VALUES(:vhsname,:category,:diffuser,:ean,:price)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vhsname', $vhsname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':diffuser', $diffuser, PDO::PARAM_STR);
        $query->bindParam(':ean', $ean, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $_SESSION['msg'] = "VHS ajouté";
            header('location:manage-vhs.php');
        } else {
            $_SESSION['error'] = "Quelque chose s'est mal passé";
            header('location:manage-vhs.php');
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
        <title>Online RENTAL | Add VHS</title>
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
                        <h4 class="header-line">Ajouter un VHS</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Formulaire d'ajout de VHS
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label>Nom du VHS<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="vhsname" autocomplete="off"
                                            required />
                                    </div>

                                    <div class="form-group">
                                        <label>Catégorie<span style="color:red;">*</span></label>
                                        <select class="form-control" name="category" required="required">
                                            <option value="">Sélectionner la Catégorie</option>
                                            <?php
                                            $status = 1;
                                            $sql = "SELECT * from  tblcategory where Status=:status";
                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':status', $status, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <option value="<?php echo htmlentities($result->id); ?>">
                                                        <?php echo htmlentities($result->CategoryName); ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>Diffuseur<span style="color:red;">*</span></label>
                                        <select class="form-control" name="diffuser" required="required">
                                            <option value="">Sélectionner le Diffuseur</option>
                                            <?php

                                            $sql = "SELECT * from  tbldiffusers ";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <option value="<?php echo htmlentities($result->id); ?>">
                                                        <?php echo htmlentities($result->DiffuserName); ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>EAN<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="ean" required="required"
                                            autocomplete="off" />
                                        <p class="help-block">Code Barre</p>
                                    </div>

                                    <div class="form-group">
                                        <label>Prix en €<span style="color:red;">*</span></label>
                                        <input class="form-control" type="text" name="price" autocomplete="off"
                                            required="required" />
                                    </div>
                                    <button type="submit" name="add" class="btn btn-info">AJOUTER</button>
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

<!-- Add-vhs.php ADMIN -->