<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    if (isset($_POST['update'])) {
        $vhsname = $_POST['vhsname'];
        $category = $_POST['category'];
        $diffuser = $_POST['diffuser'];
        $ean = $_POST['ean'];
        $price = $_POST['price'];
        $vhsid = intval($_GET['vhsid']);
        $sql = "update  tblvhs set VHSName=:vhsname,CatId=:category,DiffuserId=:diffuser,EAN=:ean,VHSPrice=:price where id=:vhsid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':vhsname', $vhsname, PDO::PARAM_STR);
        $query->bindParam(':category', $category, PDO::PARAM_STR);
        $query->bindParam(':diffuser', $diffuser, PDO::PARAM_STR);
        $query->bindParam(':ean', $ean, PDO::PARAM_STR);
        $query->bindParam(':price', $price, PDO::PARAM_STR);
        $query->bindParam(':vhsid', $vhsid, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['msg'] = "VHS édité";
        header('location:manage-vhs.php');
    }
    ?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Edit VHS</title>
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
                        <h4 class="header-line">Édition d'un VHS</h4>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Information VHS
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">
                                    <?php
                                    $vhsid = intval($_GET['vhsid']);
                                    $sql = "SELECT tblvhs.VhsName, tblvhs.VHSPrice, tblcategory.CategoryName, tblcategory.id as cid, tbldiffusers.DiffuserName, tbldiffusers.id as diffid, tblvhs.EAN, tblvhs.VhsPrice, tblvhs.id as vhsid
                                    FROM  tblvhs 
                                    JOIN tblcategory ON tblcategory.id=tblvhs.CatId 
                                    JOIN tbldiffusers ON tbldiffusers.id=tblvhs.DiffuserId 
                                    WHERE tblvhs.id=:vhsid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':vhsid', $vhsid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>

                                            <div class="form-group">
                                                <label>Nom du VHS<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="vhsname"
                                                    value="<?php echo isset($result->VHSName) ? htmlentities($result->VHSName) : ''; ?>"
                                                    required />
                                            </div>
                                            <div class="form-group">
                                                <label> Categorie<span style="color:red;">*</span></label>
                                                <select class="form-control" name="category" required="required">
                                                    <option value="<?php echo htmlentities($result->cid); ?>">
                                                        <?php echo htmlentities($catname = $result->CategoryName); ?>
                                                    </option>
                                                    <?php
                                                    $status = 1;
                                                    $sql1 = "SELECT * from  tblcategory where Status=:status";
                                                    $query1 = $dbh->prepare($sql1);
                                                    $query1->bindParam(':status', $status, PDO::PARAM_STR);
                                                    $query1->execute();
                                                    $resultss = $query1->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query1->rowCount() > 0) {
                                                        foreach ($resultss as $row) {
                                                            if ($catname == $row->CategoryName) {
                                                                continue;
                                                            } else {
                                                                ?>
                                                                <option value="<?php echo htmlentities($row->id); ?>">
                                                                    <?php echo htmlentities($row->CategoryName); ?>
                                                                </option>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Diffuseur<span style="color:red;">*</span></label>
                                                <select class="form-control" name="diffuser" required="required">
                                                    <option value="<?php echo htmlentities($result->diffid); ?>">
                                                        <?php echo htmlentities($diffname = $result->DiffuserName); ?>
                                                    </option>
                                                    <?php

                                                    $sql2 = "SELECT * from  tbldiffusers ";
                                                    $query2 = $dbh->prepare($sql2);
                                                    $query2->execute();
                                                    $result2 = $query2->fetchAll(PDO::FETCH_OBJ);
                                                    if ($query2->rowCount() > 0) {
                                                        foreach ($result2 as $ret) {
                                                            if ($diffname == $ret->DiffuserName) {
                                                                continue;
                                                            } else {

                                                                ?>
                                                                <option value="<?php echo htmlentities($ret->id); ?>">
                                                                    <?php echo htmlentities($ret->DiffuserName); ?>
                                                                </option>
                                                            <?php }
                                                        }
                                                    } ?>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>EAN<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="ean"
                                                    value="<?php echo htmlentities($result->EAN); ?>" required="required" />
                                                <p class="help-block">Code Barre</p>
                                            </div>

                                            <div class="form-group">
                                                <label>Prix en €<span style="color:red;">*</span></label>
                                                <input class="form-control" type="text" name="price"
                                                    value="<?php echo isset($result->VHSPrice) ? htmlentities($result->VHSPrice) : ''; ?>"
                                                    required />
                                            </div>
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

<!-- Edit-vhs.php ADMIN -->