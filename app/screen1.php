
<!-- Figure 1: Welcome Screen by Alexander -->
<title>Welcome to Best Book Buy Online Bookstore!</title>
<body>
	<table align="center" style="border:1px solid blue;">
	<tr><td><h2>Best Book Buy (3-B.com)</h2></td></tr>
	<tr><td><h4>Online Bookstore</h4></td></tr>
	<tr><td><form action=""  method="post">
		<input type="radio" name="group1" value="screen2.php" checked>Search Online<br/>
		<input type="radio" name="group1" value="customer_registration.php">New Customer<br/>
		<input type="radio" name="group1" value="user_login.php">Returning Customer<br/>
		<input type="radio" name="group1" value="admin_login.php">Administrator<br/>
		<input type="submit" name="submit" value="ENTER">
	</form></td></tr>
	</table>
</body>
<?php
if( isset($_POST['group1'])){
	echo "I am inside the if statement";
	header("Location: http://db2.emich.edu/~201709_cosc471_group02/COSC471_DB/app/" . $_POST['group1']);   
}
?>
</html>
