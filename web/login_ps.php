<?php
	include "../core/init.php";
	include "../core/helper.php";

	$name = sanitize($_POST['name']);
	$pass = sanitize($_POST['password']);

	$sql = "SELECT * FROM staff WHERE staffUsername = '$name' && staffPassword = '$pass'";

	$query = mysqli_query($db, $sql);
	$row = mysqli_fetch_array($query);

	if(mysqli_num_rows($query) > 0){
		$_SESSION['staffID'] = $row['staffID'];

		if($row['staffType'] == 1){
			header("Location: adminIndex.php");
		}
		else{
			header("Location: main-page.php");
		}
	}
  else{
		echo '<script> alert("Sila Masukkan Nama Dan Password Yang Betul");
		location.href= "signin.php";</script>';
	}

?>
