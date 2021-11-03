<!DOCTYPE html>
<html>
<head>
<title>Midgard</title>
<meta charset = "UTF-8">
<link rel="shortcut icon" type="image/png" href="icon.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
$link = mysqli_connect('localhost', 'ra', 'IInfinity', 'chatroom');
if (!$link){
	die('Could not connect: ' . mysqli_error());
}

$username = mysqli_real_escape_string($link,$_POST['username']);
$password = mysqli_real_escape_string($link,$_POST['password']);

if(strlen($username) <= 50  && strlen($password) <= 50 ){

	$sql="SELECT * FROM users WHERE username = '$username' AND password = '$password'";
	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) == 0) {
		$userkey = mysqli_real_escape_string($link, rand(1, 9999));
		$rand = rand(1, 10);
		$pfp = ((String)$rand.".png");
		echo "<center><h1>please read this</h1></center><br>";
		echo "your account has been added to the database succesfully. <br>";
		echo "here is your user key: $userkey, you can give this to your friends for them to add you to a chat with them or more people.<br>";
	        echo '<a href = "index.php"> try to login now</a>';
		$sql = "INSERT INTO users (username, password, userkey, profilepicture) VALUES ('$username', '$password', '$userkey', '$pfp')";
		$result = mysqli_query($link, $sql);
		$usr = str_replace(' ', '_', $username);

		$query = "SELECT * from users WHERE username = '$username' AND password = '$password'";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_row($result);
		$sp = $usr.$row['7'];
		$sql = "CREATE TABLE $sp ( chatroomname VARCHAR(50), chatkey1 INT(4), chatkey2 INT(4), messagesofusernum INT(8) DEFAULT 0 )";
		$result = mysqli_query($link, $sql);
	}
	else{
		echo "your username and password are the same as someoene else's!";
	}

	mysqli_free_result($result);

	/*while($row = mysqli_fetch_assoc($result)) {
	echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>"; }
	} else { echo "0 results"; }*/
} else {
	echo '<h1 class = "center">Your username or password are too long (over 50 characters), please <a href = "signup.php">try again</a></h1>';
}

mysqli_close($link);

?>
</body>
</html>
