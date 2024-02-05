<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $_SESSION['error'] = isset($_SESSION['error']) ? $_SESSION['error'] : "";
    $_SESSION['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : "";
    $_SESSION['updatemsg'] = isset($_SESSION['updatemsg']) ? $_SESSION['updatemsg'] : "";
    $_SESSION['delmsg'] = isset($_SESSION['delmsg']) ? $_SESSION['delmsg'] : "";
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblvhs  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "VHS supprimé ";
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
        <title>Online RENTAL | Manage VHS</title>
        <!-- BOOTSTRAP CORE STYLE -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                        <h4 class="header-line">Géré les VHS</h4>
                    </div>
                    <div class="row">
                        <?php if ($_SESSION['error'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-danger">
                                    <strong>Erreur :</strong>
                                    <?php echo htmlentities($_SESSION['error']); ?>
                                    <?php echo htmlentities($_SESSION['error'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['msg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Succès :</strong>
                                    <?php echo htmlentities($_SESSION['msg']); ?>
                                    <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($_SESSION['updatemsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Succès :</strong>
                                    <?php echo htmlentities($_SESSION['updatemsg']); ?>
                                    <?php echo htmlentities($_SESSION['updatemsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>


                        <?php if ($_SESSION['delmsg'] != "") { ?>
                            <div class="col-md-6">
                                <div class="alert alert-success">
                                    <strong>Succès :</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']); ?>
                                    <?php echo htmlentities($_SESSION['delmsg'] = ""); ?>
                                </div>
                            </div>
                        <?php } ?>

                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Liste des VHS
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>VHS</th>
                                                <th>Catégorie</th>
                                                <th>Diffuseur</th>
                                                <th>EAN</th>
                                                <th>Prix</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT tblvhs.VHSName,tblcategory.CategoryName,tbldiffusers.DiffuserName,tblvhs.EAN,tblvhs.VHSPrice,tblvhs.id as vhsid from  tblvhs join tblcategory on tblcategory.id=tblvhs.CatId join tbldiffusers on tbldiffusers.id=tblvhs.DiffuserId";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center">
                                                            <?php echo htmlentities($cnt); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->VHSName); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->CategoryName); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->DiffuserName); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->EAN); ?>
                                                        </td>
                                                        <td class="center">
                                                            <?php echo htmlentities($result->VHSPrice); ?>
                                                        </td>
                                                        <td class="center">

                                                            <a
                                                                href="edit-vhs.php?vhsid=<?php echo htmlentities($result->vhsid); ?>"><button
                                                                    class="btn btn-primary"><i class="fa fa-edit "></i>ÉDITÉ
                                                                </button>
                                                                <a href="manage-vhs.php?del=<?php echo htmlentities($result->vhsid); ?>"
                                                                    onclick="return confirm('Are you sure you want to delete?');">
                                                                    <button class="btn btn-danger"><i
                                                                            class="fa fa-pencil"></i>SUPPRIMER </button>
                                                        </td>
                                                    </tr>
                                                    <?php $cnt = $cnt + 1;
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

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
        <script src="assets/js/dataTables/jquery.dataTables.js"></script>
        <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script src="assets/js/custom.js"></script>

    </body>

    </html>
    
<?php } ?>

<!-- Manage-vhs.php ADMIN -->