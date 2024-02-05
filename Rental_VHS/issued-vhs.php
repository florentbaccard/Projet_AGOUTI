<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "delete from tblvhs  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $_SESSION['delmsg'] = "Catégorie détruite";
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
        <title>Online RENTAL | Issued VHS</title>
        <!-- BOOTSTRAP CORE STYLE -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE -->
        <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
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
                        <h4 class="header-line">Gérer les VHS emprunté(s)</h4>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <!-- Table des VHS Empruntés par l'utilisateur -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Vos VHS emprunté(s)
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover"
                                            id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nom du VHS</th>
                                                    <th>EAN</th>
                                                    <th>Date d'emprunt</th>
                                                    <th>Date de retour</th>
                                                    <th>Amende en €</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sid = $_SESSION['sid'];
                                                $sql = "SELECT tblvhs.VHSName,tblvhs.EAN,tblissuedvhsdetails.IssuesDate,tblissuedvhsdetails.ReturnDate,tblissuedvhsdetails.id as rid,tblissuedvhsdetails.fine from  tblissuedvhsdetails join tblrenters on tblrenters.RenterId=tblissuedvhsdetails.RenterId join tblvhs on tblvhs.id=tblissuedvhsdetails.VHSId where tblrenters.RenterId=:sid order by tblissuedvhsdetails.id desc";
                                                $query = $dbh->prepare($sql);
                                                $query->bindParam(':sid', $sid, PDO::PARAM_STR);
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
                                                                <?php echo htmlentities($result->EAN); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->IssuesDate); ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php if ($result->ReturnDate == "") { ?>
                                                                    <span style="color:red">
                                                                        <?php echo htmlentities("Non retourné !"); ?>
                                                                    </span>
                                                                <?php } else {
                                                                    echo htmlentities($result->ReturnDate);
                                                                }
                                                                ?>
                                                            </td>
                                                            <td class="center">
                                                                <?php echo htmlentities($result->fine ?? ''); ?>
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
                            <!-- Fin de la Table -->
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

<!-- Issued-vhs.php -->