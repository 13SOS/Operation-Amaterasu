<!DOCTYPE html>
<html>
<head>
<title>Midgard</title>
<meta charset = "UTF-8">
<link rel="shortcut icon" type="image/png" href="icon.png"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" href = "style.css">
</head>
<style>
.center{
	text-align: center;
}
.title{
	color: yellow;
	text-shadow: 2px 2px red;
	letter-spacing: 2px;
}
.text{
	color: red;
	text-shadow: 2px 2px darkred;
}
body{
	background-image: url('hermes.jpg');
}

* {
  box-sizing: border-box;
}

/* style inputs and link buttons */
input{
  width: 100%;
  padding: 12px;
  margin: 5px 0;
  display: inline-block;
  font-size: 17px;
  text-decoration: none; /* remove underline from anchors */
}
.btn{
  color: white;
}

/* style the submit button */
input[type=submit] {
  background-color: #657;
  color: white;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #659;
}

/* Two-column layout spacing */
.col {
  padding: 0 50px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

@media screen and (max-width: 650px) {
  .col {
    width: 100%;
    margin-top: 0;
  }
}
.container{
       padding: 10px 0 20px 0
}
</style>
<body>
	<div class="container">
      	  <form action="chatsearchvalidation.php" method = "POST">
	    <div class="row">
	      <div class="col">
	       	<h1 class = "title center"> Search for a chatroom! </h1>
		<input type="text" placeholder="Chat name (optional)" name = "chtname">
		<input type="text" placeholder="Chat key 1(optional)" name = "chtkey1">
		<input type="text" placeholder="Chat key 2(optional)" name = "chtkey2">
		<h2 class = "text center">if you don't enter in the chat keys (or just a key) or don't enter in the chat name we'll just show you all chats with that chat name or these chat key/s depending on what you enetered, and show you their data</h2>
		<input type="submit" value="search">
	      </div>
	    </div>
	  </form>
	</div>
</body>
</html>
