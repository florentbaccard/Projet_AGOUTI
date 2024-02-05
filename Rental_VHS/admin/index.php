<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $sql = "SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
    } else {
        echo "<script>alert('Information incorrecte');</script>";
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
        <title>Online RENTAL | Index</title>
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
                        <h4 class="header-line">Connexion Administrateur</h4>
                    </div>
                </div>

                <!-- Connexion Administrateur -->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Formulaire de Connexion
                            </div>
                            <div class="panel-body">
                                <form role="form" method="post">

                                    <div class="form-group">
                                        <label>Entrer votre Pseudo</label>
                                        <input class="form-control" type="text" name="username" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Entrer votre mot de passe</label>
                                        <input class="form-control" type="password" name="password" required />
                                    </div>
                                    <button type="submit" name="login" class="btn btn-info">CONNEXION </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin du Formulaire de Connexion Utilisateur -->


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

<!-- Index.php ADMIN -->