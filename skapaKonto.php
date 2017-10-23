		<?php
		$title = "Skapa Konto";
			include "header.php";

			if(isset($_POST['uNamn']) && isset($_POST['passW']) && isset($_POST['namn'])){
				if(strlen($_POST['uNamn']) < 3){
					header("location:index.php");
				}
				else if(strlen($_POST['passW']) < 3){
					header("location:index.php");
				}
				else if(strlen($_POST['namn']) < 3){
					header("location:index.php");
				}
				else{
				include "config.php"; //Skapa denna fil
				$username = htmlentities($_POST['uNamn']);
				$passW = htmlentities($_POST['passW']);
				$namnV = htmlentities($_POST['namn']);
				
				$passW = hasha($passW.$peppar); //Hashar lösenordet
				$sql = "INSERT INTO user values (0,?,?,?)"; //Gör stringen redo för att föras in i datta basen, gör på detta vis så att det inte ska scriptas
				if($mysqli = connect_db()){
					if($stmt = $mysqli->prepare($sql)){
						$stmt->bind_param("sss", $username, $passW,$namnV); //Binder variablerna till statementet
						$stmt->execute(); //För in variablerna
						$stmt->close(); //Stänger uppkopplingen
					}
					$mysqli->close(); //Stänger kopplingen
					header("location:index.php");
				}

			}
		}



			else{

				echo "<h1><center> Skapa Konto</center> </h1>";
				echo "<div class='inlogg'>";
				echo "<form action='skapaKonto.php' method='post'>";

				echo "<table><br><tr><td>Användarnamn: </td><td> <input type='text' name='uNamn'></td></tr>";
				echo "<tr><td>Lösenord: </td><td> <input type='password' name='passW'></td></tr>";
				echo "<tr><td> Namn: </td><td><input type='text' name='namn'></td></tr>";
				echo "<tr><td colspan='6'><br><center><input type='submit' value='Skapa konto' class='knapp'></center></td></tr>";
				echo "</table></form>";
				echo"</div>";

			}

		?>
	</body>
</html>

