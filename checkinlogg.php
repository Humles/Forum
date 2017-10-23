<?php
	session_start(); //Börjar sessionen
	if(isset($_POST['uNamn']) && isset($_POST['passWord']) && $_POST['uNamn'] != ""  && $_POST['passWord'] != "") { //Kollar om det finns någar värden och att de inte är tomma
		$un = htmlentities($_POST['uNamn']);
		$pw = htmlentities($_POST['passWord']);
		$sql = "select password, name, uname, id from user where uname = ?"; //Sätter frågan så att den inte kan skriptas med en vardump()
		include("config.php");
		if($mysqli = connect_db()){
			if($stmt = $mysqli->prepare($sql)){
				$stmt->bind_param("s", $un); //Binadar unamn string till frågan
				$stmt->execute(); //Kör statement
				$stmt->bind_result($p, $name, $user, $id);
				if($stmt->fetch()){
					//$peppar = "xddxdhuehue69420@420";
					if(checkPasswd($pw.$peppar,$p)){
						$_SESSION['id'] = $id;
						$_SESSION['uname'] = $user;
						$_SESSION['name'] = $name;
						header("location:forum.php");
					}
					else{
						header("location:index.php?fel=1");

					}

				}
				else{
					header("location:index.php?fel=2");
				}
				$stmt->close();
			}
			

		}
		else{
				header("location:index.php");
			}


	}
	else{
				header("location:index.php?fel=1");
			}