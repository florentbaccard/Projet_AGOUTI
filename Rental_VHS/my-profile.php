<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['update'])) {
        $sid = $_SESSION['sid'];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];

        $sql = "update tblrenters set FullName=:fname,MobileNumber=:mobileno where RenterId=:sid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':sid', $sid, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->execute();

        echo '<script>alert("Votre Proil à été Mis à jour")</script>';
    }

    ?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Online RENTAL | My Profile</title>
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
                        <h4 class="header-line">Profil Utilisateur</h4>

                    </div>

                </div>

                <!-- Profil Utilisateur -->
                <div class="row">

                    <div class="col-md-9 col-md-offset-1">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                Mon Profil
                            </div>
                            <div class="panel-body">
                                <form name="signup" method="post">
                                    <?php
                                    $sid = $_SESSION['sid'];
                                    $sql = "SELECT RenterId,FullName,EmailId,MobileNumber,RegDate,UpdationDate,Status from  tblrenters  where RenterId=:sid ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':sid', $sid, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>

                                            <div class="form-group">
                                                <label>ID Loueur : </label>
                                                <?php echo htmlentities($result->RenterId); ?>
                                            </div>

                                            <div class="form-group">
                                                <label>Date d'emprunt : </label>
                                                <?php echo htmlentities($result->RegDate); ?>
                                            </div>
                                            <?php if ($result->UpdationDate != "") { ?>
                                                <div class="form-group">
                                                    <label>Dernière Mise à jour : </label>
                                                    <?php echo htmlentities($result->UpdationDate); ?>
                                                </div>
                                            <?php } ?>

                                            <!-- Formulaire de mis à jour -->

                                            <div class="form-group">
                                                <label>Statut du Profil : </label>
                                                <?php if ($result->Status == 1) { ?>
                                                    <span style="color: green">Actif</span>
                                                <?php } else { ?>
                                                    <span style="color: red">Bloqué</span>
                                                <?php } ?>
                                            </div>


                                            <div class="form-group">
                                                <label>Entrer votre prénom</label>
                                                <input class="form-control" type="text" name="fullanme"
                                                    value="<?php echo htmlentities($result->FullName); ?>" autocomplete="off"
                                                    required />
                                            </div>


                                            <div class="form-group">
                                                <label>Entrer votre numéro de tél.</label>
                                                <input class="form-control" type="text" name="mobileno" maxlength="10"
                                                    value="<?php echo htmlentities($result->MobileNumber); ?>" autocomplete="off"
                                                    required />
                                            </div>

                                            <div class="form-group">
                                                <label>Votre email</label>
                                                <input class="form-control" type="email" name="email" id="emailid"
                                                    value="<?php echo htmlentities($result->EmailId); ?>" autocomplete="off"
                                                    required readonly />
                                            </div>
                                        <?php }
                                    } ?>

                                    <button type="submit" name="update" class="btn btn-primary" id="submit">Mis à
                                        jour</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Fin du Formulaire de Mis à jour -->

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

<!-- My-profile.php -->