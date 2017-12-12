
<!DOCTYPE HTML>
<head>
<title>User Login</title>
</head>
<?php
	error_reporting(E_ALL);
	ini_set("display_errors","On");
	session_start();
	$filepath = realpath(dirname(__FILE__));
	require_once($filepath .'/db_session.php');

	$db_session = new DB_Session();
	$database = $db_session->OpenCon();
	$login_status = "";

	if(isset($_POST['username']) && isset($_POST['pin'])){
		$result = $database->query("SELECT * FROM users WHERE username='" . $_POST['username'] . "' AND pin='" . $_POST['pin'] . "';");

		if($result->num_rows != 0){
			$login_status = "Success";

			while($row = $result->fetch_assoc()){
				$_SESSION['customer']['username'] = $row['username'];
				$_SESSION['customer']['firstname'] = $row['Fname'];
				$_SESSION['customer']['lastname'] = $row['Lname'];
				$_SESSION['customer']['addressId'] = $row['addressId'];
				$_SESSION['customer']['is_admin'] = $row['is_admin'];
			}

			$result = $database->query("SELECT * FROM residence WHERE addressId='" . $_SESSION['customer']['addressId'] . "';");
			if($result->num_rows != 0){
				while($row = $result->fetch_assoc()){
					$_SESSION['customer']['address'] = $row['address'];
					$_SESSION['customer']['city'] = $row['city'];
					$_SESSION['customer']['state'] = $row['state'];
					$_SESSION['customer']['zip'] = $row['zip'];
				}
			}

			$result = $database->query("SELECT * FROM credit_cards WHERE username='" . $_SESSION['customer']['username'] . "';");
			if($result->num_rows != 0){
				while($row = $result->fetch_assoc()){
					$_SESSION['customer']['credit_card_type'] = $row['type'];
					$_SESSION['customer']['card_number'] = $row['card_number'];
					$_SESSION['customer']['expiration'] = $row['expiration'];
				}
			}
			header("Location: http://db2.emich.edu/~201709_cosc471_group02/COSC471_DB/app/screen2.php");
		} else {
			$login_status = "Failed";
		}
	}

?>
<body>
	<table align="center" style="border:2px solid blue;">
		<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" id="login_screen">
		<tr>
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="username" id="username">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
			</form>
			<form action="screen1.php" method="post" id="login_screen">
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
	<p align="center"> <?php if($login_status == "Failed"){echo "<span style='color: red'>invalid credentials</span>";}?></p>
</body>

</html>
