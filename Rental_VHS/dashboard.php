<?php
session_start();

include('includes/config.php');
if (strlen($_SESSION['login']) == 0) {
  header('location:index.php');
} else { ?>

  <!DOCTYPE html>

  <html lang="fr">

  <head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Online RENTAL | User DashBoard</title>
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

  <body>

    <!-- Inclusion du menu -->
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
      <div class="container">
        <div class="row pad-botm">
          <div class="col-md-12">
            <h4 class="header-line">TABLEAU DE BORD UTILISATEUR</h4>

          </div>

        </div>

        <div class="row">

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-info back-widget-set text-center">
              <i class="fa fa-ticket fa-5x"></i>
              <?php
              $sid = $_SESSION['sid'];
              $sql1 = "SELECT id from tblissuedvhsdetails where RenterID=:sid";
              $query1 = $dbh->prepare($sql1);
              $query1->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query1->execute();
              $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
              $issuedvhs = $query1->rowCount();
              ?>

              <h3><?php echo htmlentities($issuedvhs); ?> </h3>
              VHS Emprunté
            </div>
          </div>

          <div class="col-md-3 col-sm-3 col-xs-6">
            <div class="alert alert-warning back-widget-set text-center">
              <i class="fa fa-film fa-5x"></i>
              <?php
              $rsts = 1;
              $sql2 = "SELECT id from tblissuedvhsdetails where RenterID=:sid and ReturnStatus=:rsts";
              $query2 = $dbh->prepare($sql2);
              $query2->bindParam(':sid', $sid, PDO::PARAM_STR);
              $query2->bindParam(':rsts', $rsts, PDO::PARAM_STR);
              $query2->execute();
              $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
              $returnedvhs = $query2->rowCount();
              ?>

              <h3><?php echo htmlentities($returnedvhs); ?></h3>
              VHS Non retourné
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- Inclusion du Footer -->
    <?php include('includes/footer.php'); ?>

    <!-- Script -->
    <script src="assets/js/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/custom.js"></script>

  </body>

  </html>
  
<?php } ?>

<!-- Dashboard.php -->