<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
  header('location:index.php');
} else { ?>

  <!DOCTYPE html>

  <html lang="fr">

  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>Online RENTAL | Admin DashBoard</title>
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

  </head>
  <!-- Inclusion du menu -->
  <?php include('includes/header.php'); ?>

  <div class="content-wrapper">
    <div class="container">
      <div class="row pad-botm">
        <div class="col-md-12">
          <h4 class="header-line">TABLEAU DE BORD ADMINISTRATEUR</h4>

        </div>

      </div>

      <div class="row">

        <div class="col-md-3 col-sm-3 col-xs-6">
          <a href="manage-vhs.php" class="icon-link">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-video-camera fa-5x"></i>
              <?php
              $sql = "SELECT id from tblvhs ";
              $query = $dbh->prepare($sql);
              $query->execute();
              $results = $query->fetchAll(PDO::FETCH_OBJ);
              $listdvhs = $query->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($listdvhs); ?>
              </h3>
              Nombre Total de VHS
            </div>
          </a>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <a href="manage-issued-vhs.php" class="icon-link">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-file-video-o fa-5x"></i>
              <?php
              $sql1 = "SELECT id from tblissuedvhsdetails ";
              $query1 = $dbh->prepare($sql1);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $issuedvhs = $query1->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($issuedvhs); ?>
              </h3>
              Nombre de VHS emprunté(s)
            </div>
          </a>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <a href="manage-issued-vhs.php" class="icon-link">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-laptop fa-5x"></i>
              <?php
              $status = 1;
              $sql2 = "SELECT id from tblissuedvhsdetails where ReturnStatus=:status";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':status', $status, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $returnedvhs = $query2->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($returnedvhs); ?>
              </h3>
              Nombre de VHS non rendus
            </div>
          </a>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-6">
          <a href="reg-renters.php" class="icon-link">
            <div class="alert alert-danger back-widget-set text-center">
              <i class="fa fa-users fa-5x"></i>
              <?php
              $sql3 = "SELECT id from tblrenters ";
              $query3 = $dbh->prepare($sql3);
              $query3->execute();
              $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
              $regstds = $query3->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($regstds); ?>
              </h3>
              Nombre de Loueurs
            </div>
          </a>
        </div>


        <div class="col-md-3 col-sm-3 col-xs-6">
          <a href="manage-diffusers.php" class="icon-link">
            <div class="alert alert-success back-widget-set text-center">
              <i class="fa fa-user fa-5x"></i>
              <?php
              $sq4 = "SELECT id from tbldiffusers ";
              $query4 = $dbh->prepare($sq4);
              $query4->execute();
              $results4 = $query4->fetchAll(PDO::FETCH_OBJ);
              $listddiffs = $query4->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($listddiffs); ?>
              </h3>
              Nombre de Diffuseurs
            </div>
          </a>
        </div>

        <div class="col-md-3 col-sm-3 rscol-xs-6">
          <a href="manage-categories.php" class="icon-link">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-calendar-o fa-5x"></i>
              <?php
              $sql5 = "SELECT id from tblcategory ";
              $query5 = $dbh->prepare($sql5);
              $query5->execute();
              $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
              $listdcats = $query5->rowCount();
              ?>
              <h3>
                <?php echo htmlentities($listdcats); ?>
              </h3>
              Nombre de Catégories
            </div>
          </a>
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

<!-- Dashboard.php ADMIN -->