<?php
	$title = "Kommentera";
	include "header.php";
	include "config.php";

	if(isset($_GET['tid'])){
		$tid = htmlentities($_GET['tid']);

		if(!(session_status() == PHP_SESSION_NONE)){
			session_start();
		}

		
		if($mysqli=connect_db()){
			$sql = "select heading, content, u.uname from thread t, user u where t.uid = u.id and tid = $tid";
			$res= $mysqli->query($sql);
			if($stmt = $mysqli->prepare($sql)){
				$stmt->execute();
				$stmt->bind_result($heading, $content, $uname);
				while($stmt->fetch()){
					echo "<div id='Kommentera'>";
					echo "<p> Titel: $heading</p>";
					echo "<p> Innehåll: $content</p>";
					echo "<p> Av: $uname </p>";
					echo "</div>";
					echo "<h2> Tidigare kommentarer: </h2>";
				}

			}	
			
		}

		if($mysqli=connect_db()){
			$sql = "select u.uname, a.content from whoanswer w, answer a, user u where u.id = w.uid and a.aid = w.aid and w.tid=$tid";
			$res=$mysqli->query($sql);
				if($res->num_rows>0){
							while($row= $res->fetch_assoc()){
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
		
		

		echo "<h1> Kommentera </h1>";
		echo "<form method ='post' action='skickaSvar.php'>";
		echo "<tr><td><textarea rows='6' cols ='40' name='kommentar'></textarea></td></tr><br>";
		echo "<input type='hidden' name='tid' value=" .$tid.">";
		echo "<input type='submit' value='Kommentera'></input>";
		echo "</form>";
	}

	else{
		header("location:index.php");
	}
		
	include"footer.php";
?>