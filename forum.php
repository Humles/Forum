<?php
	$title="Forum #1";
	include("config.php");
	include("header.php");

	session_start();
	if(isset($_SESSION['id']) && isset($_SESSION['uname']) && isset($_SESSION['name'])){

		echo "<h1> Välkommen till det bästa forumet någonsin! </h1>";
		echo "<div id=info>   Välkommen " . $_SESSION['name']. " till det bästa forumet!         ";
		echo "<a href ='loggaUt.php'><button class='knapp'> Logga Ut</button></a></div>";
?>
		
		<a href='skapaNyTrad.php'><button class ='knapp'>Skapa en ny tråd</button></a>


<?php
		if($mysqli = connect_db()){
			$sql="select tid, heading, content, u.uname from thread t, user u where t.uid = u.id order by tid desc limit 10";
			$res=$mysqli->query($sql);
			if($stmt = $mysqli->prepare($sql)){
				$stmt->execute();
				$stmt->bind_result($tid, $heading, $content, $uname);
				while($stmt->fetch()){
					echo "<div class='lada'>";
					echo "<p>Header: $heading </p>";
					echo "<p>Tråd ID: $tid</p>";
					echo "<p>Skapad av: $uname</p>";
					echo "<p>Innehåll: $content</p>";
					echo "<a href ='svar.php?tid=$tid'><button class='knapp'>Kommentera</button></a>";

					$sql1="select u.uname, a.content from whoanswer w, answer a, user u where u.id = w.uid and a.aid = w.aid and w.tid=$tid";
					$mysqli2 = connect_db();
					$res1=$mysqli2->query($sql1);

						if($res1->num_rows>0){
							while($row= $res1->fetch_assoc()){
								echo "<div class ='kommentar'>";
								echo "<ul>";
								echo "<p>Namn: " . $row['uname'] . "</p>";
								echo "<p>Kommentar: " . $row['content'] . "</p>";
								echo "</ul>";
								echo "</div>";
								
								
							}
						}
						echo "</div>";
				}
			$stmt->close();

			

		}

}

		

	include "footer.php";
	

}


	else{
		header("location:index.php");
	}
?>