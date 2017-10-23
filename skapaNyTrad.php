<?php
	
	if((session_status() == PHP_SESSION_NONE)){
		session_start();
	}
	$title ="Skapa ny tråd";
	include "header.php";
	include "config.php";
		
		if(isset($_POST['titel']) && isset($_POST['innehåll']) && isset($_POST['kategori'])){
			$titel = htmlentities($_POST['titel']);
			$innehåll = htmlentities($_POST['innehåll']);
			$kategori = htmlentities($_POST['kategori']);
			$id = $_SESSION['id'];

			$sql="INSERT INTO thread values (0,?,?,?)";
			if($mysqli = connect_db()){
				if($stmt = $mysqli->prepare($sql)){
					$stmt->bind_param("ssi", $titel, $innehåll, $id);
					$stmt->execute();
					$stmt->close();
				}
			}

			//Kategori och Uid är isatta i varandra FIXA!
			$mysqli->close();
			$sql ="INSERT INTO belong values ((select tid from thread order by tid desc limit 1),?)";
			if($mysqli = connect_db()){
				if($stmt = $mysqli->prepare($sql)){
					$stmt->bind_param("i",$kategori);
					$stmt->execute();
					$stmt->close();
				}
			}
			$mysqli->close();
			
			header("location:forum.php");
		}


		else{
			echo "<h1> Skapa Tråd </h1>";
			echo "<form action='skapaNyTrad.php' method='post'>";
			echo "<table><tr><td>Titel: </td><td><input type='text' name='titel'></td></tr>";
			echo "<tr><td>Innehåll: </td><td><textarea rows='4' cols='50' name='innehåll'></textarea></td></tr>";
			if($mysqli = connect_db()){
				$sql= "select cid, name from category";
				$res= $mysqli->query($sql) or die(mysqli_error($mysqli));
				if($stmt = $mysqli -> prepare($sql)){
					$stmt->execute();
					$stmt->bind_result($cid, $name);
					echo "<select name='kategori'>";
					while($stmt->fetch()){
						echo "<option value=$cid> $name </option>";
					}
					echo "</select>";
					$stmt->close();
				}
			}
			echo "<tr><td><input type='submit' value='Skapa tråd'></td></tr>";
			echo "</table></form>";

		}

				


	include ("footer.php");
?>