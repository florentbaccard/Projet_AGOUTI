<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // Code pour Bloqué un Loueur    
    if (isset($_GET['inid'])) {
        $id = $_GET['inid'];
        $status = 0;
        $sql = "update tblrenters set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-renters.php');
    }

    // Code pour Rendre un Actif un Loueur qui était Bloqué
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = 1;
        $sql = "update tblrenters set Status=:status  WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        header('location:reg-renters.php');
    }

    // Code pour Supprimer un Loueur
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        $sql = "DELETE FROM tblrenters WHERE id = :id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);

        if ($query->execute()) {
            $_SESSION['delmsg'] = "Loueur supprimé";
        } else {
            $_SESSION['delmsg'] = "Erreur" . print_r($query->errorInfo(), true);
        }

        header('location:reg-renters.php');
    }


?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | Manage Reg Renters</title>
        <!-- BOOTSTRAP CORE STYLE  -->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONT AWESOME STYLE  -->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- DATATABLE STYLE  -->
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
                        <h4 class="header-line">Géré les Loueurs Réguliers</h4>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Loueurs Réguliers
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID du Loueur</th>
                                                <th>Nom du Loueur</th>
                                                <th>Email</th>
                                                <th>Numéro de tél.</th>
                                                <th>Date d'Ajout</th>
                                                <th>Statut</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $sql = "SELECT * from tblrenters";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {               ?>
                                                    <tr class="odd gradeX">
                                                        <td class="center"><?php echo htmlentities($cnt); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->RenterId); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->FullName); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->EmailId); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->MobileNumber); ?></td>
                                                        <td class="center"><?php echo htmlentities($result->RegDate); ?></td>
                                                        <td class="center"><?php if ($result->Status == 1) {
                                                                                echo htmlentities("Active");
                                                                            } else {


                                                                                echo htmlentities("Blocked");
                                                                            }
                                                                            ?></td>
                                                        <td class="center">
                                                            <?php if ($result->Status == 1) { ?>
                                                                <a href="reg-renters.php?inid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Voulez vous bloqué cet utilisateur ?');" class="btn btn-danger">INACTIF</a>
                                                            <?php } else { ?>
                                                                <a href="reg-renters.php?id=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Voulez vous rendre actif cet utilisateur ?');" class="btn btn-primary">ACTIF</a>
                                                            <?php } ?>
                                                            <a href="reg-renters.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger"><i class="fa fa-pencil"></i>SUPPRIMER</a>

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

<!-- Reg-renters.php ADMIN -->