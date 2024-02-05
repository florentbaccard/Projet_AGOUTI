<?php
require_once("includes/config.php");
if (!empty($_POST["renterid"])) {
  $renterid = strtoupper($_POST["retnerid"]);

  $sql = "SELECT FullName,Status FROM tblrenters WHERE RenterId=:renterid";
  $query = $dbh->prepare($sql);
  $query->bindParam(':renterid', $renterid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) {
      if ($result->Status == 0) {
        echo "<span style='color:red'> Loueur Bloqué</span>" . "<br />";
        echo "<b>Renter Name-</b>" . $result->FullName;
        echo "<script>$('#submit').prop('disabled',true);</script>";
      } else {
?>

<?php
        echo htmlentities($result->FullName);
        echo "<script>$('#submit').prop('disabled',false);</script>";
      }
    }
  } else {

    echo "<span style='color:red'>Id incorrecte</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}

?>

<!-- Get_renter.php ADMIN -->