<?php
$title="Logga in";
include "header.php";
	if(isset($_GET['fel'])){
		$fel = $_GET['fel'];
		if($fel==1){
			echo "<p> Du måste ha lagt in både användarnamn och lösenord för att logga in</p>";
		}
		if($fel==2){
			echo "<p> Fel användarnamn eller lösenord";
		}
	}
		?>

		<h1><center> Välkommen till det bästa forumet!</center></h1>
		<div class="inlogg">
		<form action = "checkInlogg.php" method ="post">
			<table>
				<br>
				<tr><td>Användranamn: </td><td><input type ="text" name="uNamn" class="input"></input></td></tr>
				<tr><td>Lösenord: </td><td><input type="password" name="passWord"></input></td></tr>
				<tr><td colspan="10"><center> <br><input type="submit" value="Logga In" class="knapp"></center></td></tr>
				
			</table>
		</form>
		<p> <center>Om du inte har ett konto, klicka <a href="skapaKonto.php" >här</a></center></p>
		</div>

		

	</body>
</html>