<?php
require_once("includes/config.php");
if (!empty($_POST["vhsid"])) {
  $vhsid = $_POST["vhsid"];

  $sql = "SELECT VHSName,id FROM tblvhs WHERE (EAN=:vhsid)";
  $query = $dbh->prepare($sql);
  $query->bindParam(':vhsid', $vhsid, PDO::PARAM_STR);
  $query->execute();
  $results = $query->fetchAll(PDO::FETCH_OBJ);
  $cnt = 1;
  if ($query->rowCount() > 0) {
    foreach ($results as $result) { ?>
      <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->VhsName); ?></option>
      <b>VHS Name :</b>
    <?php
      echo htmlentities($result->VhsName);
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  } else { ?>

    <option class="others">Invalid EAN</option>
<?php
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }
}

?>

<!-- Get_vhs.php ADMIN -->