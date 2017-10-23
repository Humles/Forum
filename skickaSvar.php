<?php
	include "config.php";

	if((session_status() == PHP_SESSION_NONE)){
		session_start();
	}
	
	if(isset($_POST['tid']) && isset($_SESSION['id']) && isset($_POST['kommentar'])){
		$tid=htmlentities($_POST['tid']);
		$uid=htmlentities($_SESSION['id']);
	
		$kommentar = htmlentities($_POST['kommentar']);
		$sql = "INSERT INTO answer values(0,?)";
		if($mysqli=connect_db()){
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("s", $kommentar);
				$stmt->execute();
				$stmt->close();
			}
		}


		$sql = "INSERT INTO whoanswer values(?, ?, (select aid from answer order by aid desc limit 1))";
		if($mysqli=connect_db()){
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("ii", $uid, $tid);
				$stmt->execute();
				$stmt->close();
			}
		}


		header("location:forum.php");

		
	}

	else{
		header("location:index.php");
		
		}
?>