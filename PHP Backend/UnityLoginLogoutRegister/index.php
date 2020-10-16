<?php

include("config.php");

if(isset($_POST["newAccountUsername"])){
	$username = mysqli_real_escape_string($connection, $_POST["newAccountUsername"]);
	$password = mysqli_real_escape_string($connection, $_POST["newAccountPassword"]);
	//Check are they empty?
	if($username != "" && $password != ""){
		//Check is the username has not taken
		if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM unity_users WHERE username = '$username'")) == 0){
			mysqli_query($connection, "INSERT INTO unity_users (username, password) VALUES ('$username', '$password')");
			echo "Regitering new account: Username " . $username . " and password: " . $password;
		}else{
			echo "This Username is not available. Please use another username.";
		}		
	}else{
		echo "Both fields are required.";
	}
}else if(isset($_POST["loginUsername"])){
	$username = mysqli_real_escape_string($connection, $_POST["loginUsername"]);
	$password = mysqli_real_escape_string($connection, $_POST["loginPassword"]);
	if($username != "" && $password != ""){
		//Check are entered username and password matched
		$sql = "SELECT * FROM unity_users WHERE username = '$username' AND password = '$password'";
		if(mysqli_num_rows(mysqli_query($connection, $sql)) > 0){
			echo 1;
		}else{
			echo 0;
		}
	}else{
		echo "Both fields are required.";
	}
}else{
	echo "Unity Login Logout and Register";
}

?>