<?php
session_start();
include('includes/config.php');

if (isset($_POST['signup'])) {
    // Code de vérification Catpcha
    if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
        echo "<script>alert('Vérification incorrecte');</script>";
    } else {
        // Code pour les Utilisateur
        $count_my_page = ("Rentalid.txt");
        $hits = file($count_my_page);
        $hits[0]++;
        $fp = fopen($count_my_page, "w");
        fputs($fp, "$hits[0]");
        fclose($fp);
        $RenterId = $hits[0];
        $fname = $_POST['fullanme'];
        $mobileno = $_POST['mobileno'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $status = 1;
        $sql = "INSERT INTO  tblrenters(RenterId,FullName,MobileNumber,EmailId,Password,Status) VALUES(:RenterId,:fname,:mobileno,:email,:password,:status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':RenterId', $RenterId, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            echo '<script>alert("Inscription complète voici votre id de loueur : "+"' . $RenterId . '")</script>';
        } else {
            echo "<script>alert('Quelque chose à mal tourner');</script>";
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
    <title>Online RENTAL | Signup</title>
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

    <!-- Script -->

    <script type="text/javascript">
        function valid() {
            if (document.signup.password.value != document.signup.confirmpassword.value) {
                alert("Mot de passe et Confirmation différente !");
                document.signup.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'emailid=' + $("#emailid").val(),
                type: "POST",
                success: function (data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function () { }
            });
        }
    </script>

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
                    <h4 class="header-line">Inscription Utilisateur</h4>
                </div>

            </div>
            <div class="row">

                <div class="col-md-9 col-md-offset-1">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Formulaire d'Inscription
                        </div>
                        <div class="panel-body">
                            <form name="signup" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <label>Entrer votre Prénom</label>
                                    <input class="form-control" type="text" name="fullanme" autocomplete="off"
                                        required />
                                </div>


                                <div class="form-group">
                                    <label>Entrer votre numéro de Tél.</label>
                                    <input class="form-control" type="text" name="mobileno" maxlength="10"
                                        autocomplete="off" required />
                                </div>

                                <div class="form-group">
                                    <label>Entrer votre Email</label>
                                    <input class="form-control" type="email" name="email" id="emailid"
                                        onBlur="checkAvailability()" autocomplete="off" required />
                                    <span id="user-availability-status" style="font-size:12px;"></span>
                                </div>

                                <div class="form-group">
                                    <label>Entrer votre mot de passe</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off"
                                        required />
                                </div>

                                <div class="form-group">
                                    <label>Confirmation</label>
                                    <input class="form-control" type="password" name="confirmpassword"
                                        autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Code de Vérification : </label>
                                    <input type="text" name="vercode" maxlength="5" autocomplete="off" required
                                        style="width: 150px; height: 25px;" />&nbsp;<img src="captcha.php">
                                </div>
                                <button type="submit" name="signup" class="btn btn-danger"
                                    id="submit">S'ENREGISTRER</button>
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

<!-- Signup.php -->