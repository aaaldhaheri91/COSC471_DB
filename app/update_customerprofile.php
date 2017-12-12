
<!DOCTYPE HTML>
<head>
<title>UPDATE CUSTOMER PROFILE</title>

</head>
	<?php
		// error_reporting(E_ALL);
		// ini_set("display_errors","On");
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$db_session = new DB_Session();
		$database = $db_session->OpenCon();

		//check if customer wants to update
		if(isset($_POST['new_pin']) || isset($_POST['firstname']) || isset($_POST['lastname'])){

			$database->query("UPDATE users SET pin='" . $_POST['new_pin'] . "', Fname='" . $_POST['firstname'] . "', Lname='" . $_POST['lastname'] . "'
												WHERE username='" . $_SESSION['customer']['username'] . "';");
			$database->query("UPDATE residence SET address='" . $_POST['address'] . "', city='" . $_POST['city'] . "', state='" . $_POST['state'] .
												"', zip='" . $_POST['zip'] . "' WHERE address='" . $_SESSION['customer']['address'] . "';");
			$database->query("UPDATE credit_cards SET card_number='" . $_POST['card_number'] . "', type='" . $_POST['credit_card'] . "', expiration='" . $_POST['expiration_date'] . "'
												WHERE card_number='" . $_SESSION['customer']['card_number'] . "';");

			//save new update data to session
			$_SESSION['customer']['credit_card_type'] = $_POST['credit_card'];
			$_SESSION['customer']['card_number'] = $_POST['card_number'];
			$_SESSION['customer']['expiration'] = $_POST['expiration_date'];
			$_SESSION['customer']['address'] = $_POST['address'];
			$_SESSION['customer']['city'] = $_POST['city'];
			$_SESSION['customer']['state'] = $_POST['state'];
			$_SESSION['customer']['zip'] = $_POST['zip'];
			$_SESSION['customer']['firstname'] = $_POST['firstname'];
			$_SESSION['customer']['lastname'] = $_POST['lastname'];

			header("Location: http://db2.emich.edu/~201709_cosc471_group02/COSC471_DB/app/confirm_order.php");
		}
	?>
<body>
	<form id="update_profile" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Username: &nbsp;<?php echo $_SESSION['customer']['username'] ?>
			</td>
			<td colspan="3" align="center">
			</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname" value="<?php echo $_SESSION['customer']['firstname']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname" value="<?php echo $_SESSION['customer']['lastname']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address" value="<?php echo $_SESSION['customer']['address']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city" value="<?php echo $_SESSION['customer']['city']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option <?php if($_SESSION['customer']['state'] == "Michigan"){echo "selected";}?>>Michigan</option>
				<option <?php if($_SESSION['customer']['state'] == "California"){echo "selected";}?>>California</option>
				<option <?php if($_SESSION['customer']['state'] == "Tennessee"){echo "selected";}?>>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="zip" name="zip" value="<?php echo $_SESSION['customer']['zip']?>">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option <?php if($_SESSION['customer']['credit_card_type'] == "VISA"){echo "selected";}?>>VISA</option>
				<option <?php if($_SESSION['customer']['credit_card_type'] == "MASTER"){echo "selected";}?>>MASTER</option>
				<option <?php if($_SESSION['customer']['credit_card_type'] == "DISCOVER"){echo "selected";}?>>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number" value="<?php echo $_SESSION['customer']['card_number']?>">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY" value="<?php echo $_SESSION['customer']['expiration']?>">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
		<form id="cancel" action="confirm_order.php"  method="post">
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>
