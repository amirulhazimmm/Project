<?php

    include "../core/helper.php";
    include "../core/init.php";
    
    if(!$_SESSION['staffID']){
		header("Location: ../index.html");
	}

    $id = $_SESSION['staffID'];
    
    $sql = "INSERT INTO carrymark (carryMarkID, markLab, markQ_A, markTest1, markTest2, markProposal, markPresentation, markReport)
								VALUES ('', '', '', '', '', '', '', '')";
                $query = mysqli_query($db, $sql);
                
                








?>