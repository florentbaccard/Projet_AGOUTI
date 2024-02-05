<?php
require_once("includes/config.php");
// Code de vérification de l'email utilisateur
if (!empty($_POST["emailid"])) {
	$email = $_POST["emailid"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {

		echo "error : Email incorrecte";
	} else {
		$sql = "SELECT EmailId FROM tblrenters WHERE EmailId=:email";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		$cnt = 1;
		if ($query->rowCount() > 0) {
			echo "<span style='color:red'> Email existant</span>";
			echo "<script>$('#submit').prop('disabled',true);</script>";
		} else {

			echo "<span style='color:green'> Email disponible</span>";
			echo "<script>$('#submit').prop('disabled',false);</script>";
		}
	}
}
?>

<!-- Check_availabitly.php-->