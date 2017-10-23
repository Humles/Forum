<?php 
$peppar =  "xddxdhuehue69420@420";
	// Definera en funktion som sköter uppkoppling till databasen
function connect_db() { 

		// Här ska du lägga in anslutningsinformation för att kunna ansluta dig mot din databas:
		// DittAnvändarID, DittLösen och den databas du har skapat tabellerna i.

	$mysqli = new mysqli('localhost', 'root', '', 'forum');

		//Kontrollerar teckentabell
	if (!$mysqli->set_charset("utf8")) {
		echo "Fel vid inställning av teckentabell utf8: %s\n". $mysqli->error;
	} else {
 		//echo "Nuvarande teckenkodningstabell: %s\n". $mysqli->character_set_name();
	}

	if ($mysqli->connect_errno) {
		echo "Misslyckades att ansluta till MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	return $mysqli;
}

function hasha($str) {
	$hash = password_hash($str, PASSWORD_DEFAULT);
	return $hash;
}

function checkPasswd($pw,$p) {
	return password_verify($pw, $p);
}

?>