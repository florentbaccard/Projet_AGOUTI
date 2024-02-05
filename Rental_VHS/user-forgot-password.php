<?php
session_start();

include('includes/config.php');
if (isset($_POST['change'])) {
  // Code de vérification Catpcha
  if ($_POST["vercode"] != $_SESSION["vercode"] or $_SESSION["vercode"] == '') {
    echo "<script>alert('Code de Vérification incorrecte');</script>";
  } else {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);
    $sql = "SELECT EmailId FROM tblrenters WHERE EmailId=:email and MobileNumber=:mobile";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tblrenters set Password=:newpassword where EmailId=:email and MobileNumber=:mobile";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      echo "<script>alert('Mot de passe changé');</script>";
    } else {
      echo "<script>alert('Email ou Numéro de tél. incorrecte');</script>";
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
  <title>Online RENTAL | Password Recovery </title>
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

  <!-- Script -->

  <script type="text/javascript">
    function valid() {
      if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
        alert("Mot de passe et confirmation différente !");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>

</head>

<body>

  <!-- Inclusion du menu -->
  <?php include('includes/header.php'); ?>

  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">Récupération mot de passe Utilisateur</h4>
        </div>
      </div>

      <!-- Mot de Passe Oublié -->
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
          <div class="panel panel-info">
            <div class="panel-heading">
              Formulaire de Création d'un nouveau mot de passe
            </div>
            <div class="panel-body">
              <form role="form" name="chngpwd" method="post" onSubmit="return valid();">

                <div class="form-group">
                  <label>Entrer votre Email</label>
                  <input class="form-control" type="email" name="email" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Entrer votre numéro de Tél.</label>
                  <input class="form-control" type="text" name="mobile" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Nouveau mot de passe</label>
                  <input class="form-control" type="password" name="newpassword" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Confirmation</label>
                  <input class="form-control" type="password" name="confirmpassword" required autocomplete="off" />
                </div>

                <div class="form-group">
                  <label>Code de Vérification : </label>
                  <input type="text" class="form-control1" name="vercode" maxlength="5" autocomplete="off" required style="height:25px;" />&nbsp;<img src="captcha.php">
                </div>

                <button type="submit" name="change" class="btn btn-info">CONFIRMATION</button> | <a href="index.php">CONNEXION</a>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin du Formulaire de Récupération mot de passe Utilisateur -->
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

<!-- User-forgot-password.php -->