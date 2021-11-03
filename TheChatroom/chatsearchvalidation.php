<!DOCTYPE html>
<html>
<head>
<title>Midgard</title>
<meta charset = "UTF-8">
<link rel="shortcut icon" type="image/png" href="icon.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
body{
   background-color: black;
}
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px red;
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th {
    background-color: #009879
}
.styled-table td {
    padding: 12px 15px;
    background-color: white;
}
.styled-table tbody tr:hover {
    font-weight: bold;
    color: #009879;
}
.yellow{
  color: yellow;
}
</style>
<body>
<?php
$link = mysqli_connect('localhost', 'ra', 'IInfinity', 'chatroom');
if (!$link){
	die('Could not connect: ' . mysqli_error());
}

$chatname = mysqli_real_escape_string($link,$_POST['chtname']);
$chatkey1 = mysqli_real_escape_string($link,$_POST['chtkey1']);
$chatkey2 = mysqli_real_escape_string($link,$_POST['chtkey2']);


//todo: next add checks if user with said password exists and if yes, if yes we create the juicy chatroom in the chatrooms table and make it's own chatroom table with a user having owner status, add to the user's chatroom table this chatroom.
//usrinvites table and on the main screen an invites button

if($chatname != "" || $chatkey1 != "" || $chatkey2 != "" ){


	$sql="SELECT * FROM chatrooms WHERE chatroomname = '$chatname' OR chatkey1 = '$chatkey1' OR chatkey2 = '$chatkey2'";
	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) != 0) {
		if($chatname == ""){
			if($chatkey1 == ""){
				$query="SELECT * FROM chatrooms WHERE chatkey2 = '$chatkey2'";
			}
			else if($chatkey2 == ""){
				$query="SELECT * FROM chatrooms WHERE chatkey1 = '$chatkey1'";
			}
			else{
				$query="SELECT * FROM chatrooms WHERE chatkey1 = '$chatkey1' AND chatkey2 = '$chatkey2'";
			}
		} else if($chatkey1 == ""){
				if($chatkey2 == ""){
					$query="SELECT * FROM chatrooms WHERE chatroomname = '$chatname'";
				} else{
					$query="SELECT * FROM chatrooms WHERE chatroomname = '$chatname' AND chatkey1 = '$chatkey1'";
				}
			} else if ($chatkey2 == "") {
				$query="SELECT * FROM chatrooms WHERE chatroomname = '$chatname' AND chatkey2 = '$chatkey2'";
			} else {
				$query="SELECT * FROM chatrooms WHERE chatroomname = '$chatname' AND chatkey1 = '$chatkey1' AND chatkey2 ='$chatkey2'";
			}
		if ($result = mysqli_query($link, $query)) {
					echo '<center><h1 class = "yellow">Results</h1><table class="styled-table">';
					  echo '<thead>';
					    echo '<tr>';
				 	      echo "<th>Username</th>";
				              echo '<th>Userkey1</th>';
					      echo '<th>Userkey2</th>';
					      echo '<th>Profile picture</th>';
					    echo '</tr>';
					  echo '</thead>';
					echo '<tbody>';
					while($row = mysqli_fetch_row($result)){
						    echo '<tr class = "active-row">';
						      echo '<td>',$row['0'],'</td>';
						      echo '<td>',$row['2'],'</td>';
						      echo '<td>',$row['3'],'</td>';
						      echo '<td>','<img src = "'.$row['4'].'" alt = "pfp"/></td>';
			 			    echo '</tr>';
					}
                                          echo '</tbody>';
					echo '</table><h1><a href = "chatsearch.php">search for another chatroom?</a></h1></center>';
		}
	}else{
		echo '<h1><a href = "chatsearch.php">There is no chatroom like that!</a></h1>';
	}

	mysqli_free_result($result);

} else {
	echo '<h1 class = "center"><a href = "chatsearch.php">You have to enter a chat name or a chat key at least!</a></h1>';
}

mysqli_close($link);

?>
</body>
</html>
