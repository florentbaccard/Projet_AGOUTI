<?php
session_start();

include('includes/config.php');
if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
    $_SESSION['login'] = '';
}

if (isset($_POST['login'])) {
    // Code de vérification Catpcha
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Vérification incorrecte');</script>";
    } else {
        $email = $_POST['emailid'];
        $password = md5($_POST['password']);
        $sql = "SELECT EmailId,Password,RenterId,Status FROM tblrenters WHERE EmailId=:email and Password=:password";
        $query = $dbh->prepare($sql);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $_SESSION['sid'] = $result->RenterId;
                if ($result->Status == 1) {
                    $_SESSION['login'] = $_POST['emailid'];
                    echo "<script type='text/javascript'> document.location ='dashboard.php'; </script>";
                } else {
                    echo "<script>alert('Votre Compte a été bloqué');</script>";
                }
            }
        } else {
            echo "<script>alert('Information Incorrecte');</script>";
        }
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

    <!--IMAGE-->
    <br>
    <div class="text-center">
        <img src="assets/img/vhs.gif" style="width: 80vw; max-width: 100%; height: 400px;" alt="Image VHS">
    </div>


    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">Connexion Utilisateur</h4>
                </div>
            </div>

            <!-- Connexion Utilisateur -->
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Formulaire de Connexion
                        </div>
                        <div class="panel-body">
                            <form role="form" method="post">

                                <div class="form-group">
                                    <label>Entrer votre Email</label>
                                    <input class="form-control" type="text" name="emailid" required autocomplete="off" />
                                </div>

                                <div class="form-group">
                                    <label>Entrer votre mot de passe</label>
                                    <div class="input-group">
                                        <input id="password" class="form-control" type="password" name="password" required autocomplete="off" />
                                        <div class="input-group-append" style="display: flex;">
                                            <span class="input-group-text">
                                                <a href="javascript:void(0);" id="showPassword" style="margin-left: 10px;">
                                                    <i class="fa fa-eye eye-open" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <p class="help-block text-left"><a href="user-forgot-password.php">Mot de passe oublié</a></p>
                                </div>

                                <!-- Style -->
                                <style>
                                    .eye-open {
                                        background: none;
                                        border: none;
                                        padding: 0;
                                        cursor: pointer;
                                    }

                                    .eye-closed {
                                        background: none;
                                        border: none;
                                        padding: 0;
                                        cursor: pointer;
                                    }
                                </style>

                                <div class="form-group">
                                    <label>Code de Vérification : </label>
                                    <input type="text" class="form-control1" name="vercode" maxlength="5" autocomplete="off" required style="height:25px;" />&nbsp;<img src="captcha.php">
                                </div>

                                <button type="submit" name="login" class="btn btn-info">CONNEXION </button> | <a href="signup.php">S'inscrire</a>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>

    <!-- Fonction Afficher/Masquer oeil mot de passe -->
    <script>
        $(document).ready(function() {
            $("#showPassword").click(function() {
                var passwordInput = $("#password");
                var passwordFieldType = passwordInput.attr("type");

                if (passwordFieldType === "password") {
                    passwordInput.attr("type", "text");
                    $("#showPassword i").removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    passwordInput.attr("type", "password");
                    $("#showPassword i").removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
    </script>

</body>

</html>

<!-- Index.php -->