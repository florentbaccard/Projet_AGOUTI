<?php
session_start();
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else {
  if (isset($_POST['change'])) {
    $error = "";
    $msg = "";
    $password = md5($_POST['password']);
    $newpassword = md5($_POST['newpassword']);
    $email = $_SESSION['login'];
    $sql = "SELECT Password FROM tblrenters WHERE EmailId=:email and Password=:password";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    if ($query->rowCount() > 0) {
      $con = "update tblrenters set Password=:newpassword where EmailId=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg = "Mot de passe changé";
    } else {
      $error = "Mot de passe actuel incorrecte";
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
    <title>Online RENTAL | Change PSWD </title>
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

    <!-- Styles -->
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }

      .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
      }
    </style>

  </head>

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

  <body>

    <!-- Inclusion du menu -->
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">Changement de mot de passe Utilisateur</h4>
          </div>
        </div>
        <?php if (isset($error) && $error != '') { ?><div class="errorWrap"><strong>ERREUR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if (isset($msg) && $msg != '') { ?><div class="succWrap"><strong>SUCCÈS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

        <!-- Formulaire de changement de mot de passe -->
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                Changer de mot de passe
              </div>
              <div class="panel-body">
                <form role="form" method="post" onSubmit="return valid();" name="chngpwd">

                  <div class="form-group">
                    <label>Mot de passe actuel</label>
                    <input class="form-control" type="password" name="password" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label>Nouveau mot de passe</label>
                    <input class="form-control" type="password" name="newpassword" autocomplete="off" required />
                  </div>

                  <div class="form-group">
                    <label>Confirmation du mot de passe</label>
                    <input class="form-control" type="password" name="confirmpassword" autocomplete="off" required />
                  </div>

                  <button type="submit" name="change" class="btn btn-info">CHANGER </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Fin du Formulaire de Changement de mot de passe -->

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

<!-- Change-password.php -->