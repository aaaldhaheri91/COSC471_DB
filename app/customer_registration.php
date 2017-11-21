
<!-- UI: Prithviraj Narahari, php code: Alexander Martens -->
<head>
<title> CUSTOMER REGISTRATION </title>

<?php
	error_reporting(E_ALL);
	ini_set("display_errors","On");
	session_start();
	$filepath = realpath(dirname(__FILE__));
	require_once($filepath .'/db_session.php');

	$data = array();
	$exist = False;
	$db_session = new DB_Session();
	$database = $db_session->OpenCon();


	//query the database table and display information
	if(isset($_POST['username'])){

		$result = $database->query("SELECT username FROM users WHERE username='" . $_POST['username'] . "'");

		if($result->num_rows == 0){
			//insert address information
			$database->query("INSERT INTO residence (address, city, state, zip)
											  VALUES('" . $_POST['address'] . "','" . $_POST['city'] . "','" . $_POST['state'] . "','" . $_POST['zip'] . "');");
			$id = $database->insert_id;
			//insert user information
			$result = $database->query("INSERT INTO users (username, pin, Fname, Lname, addressId)
											  VALUES('" . $_POST['username'] . "','" . $_POST['pin'] . "','" . $_POST['firstname'] . "','" . $_POST['lastname'] . "','" . $id . "');");
			if($result === false)
				echo "insert into users failed<br>";

			$result = $database->query("INSERT INTO credit_cards (card_number, username, type, expiration)
												VALUES('" . $_POST['card_number'] . "','" . $_POST['username'] . "','" . $_POST['credit_card'] . "','" . $_POST['expiration'] . "');");
			if($result === false)
				echo "insert into credit_cards failed";
			//header("Location: http://db2.emich.edu/~201709_cosc471_group02/COSC471_DB/app/confirm_order.php");
		} else {
			$exist = True;
		}

	}

?>

</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<form id="register" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username" required>
				<?php if($exist){ ?>
					<span style="color: red">username already exist</span>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" required>
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<form id="no_registration" action="dont_register.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register">
			</td>
			</form>
		</tr>
	</table>
</body>

</HTML>
