
<!DOCTYPE HTML>
<head>
<title>Admin Login</title>
</head>

<body>
	<?php 
		$name = $_POST['adminname'];
		$pin = $_POST['pin'];
		
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$data = array();
		$db_session = new DB_Session();
		$database = $db_session->OpenCon();
		
		$data = $database->query("SELECT * FROM users WHERE isAdmin = 1");
		
		if (!is_null($_POST[adminname])) {
			if($data) {
			$row = $data->fetch_assoc();
			if($name == $row['username'] && $pin == $row['pin']) {
				header("Location: http://db2.emich.edu/~201709_cosc471_group02/COSC471_DB/app/reports.php");
			}
			else {
				echo '<script type="text/javascript">alert("Please Enter Valid Admin Credentials!");</script>';
			}
		}
		}
	?>
<table align="center" style="border:2px solid blue;">
		<form action="admin_login.php" method="post" id="adminlogin_screen">
		<tr>
			<td align="right">
				Adminname<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="adminname" id="adminname">
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
</body>



</html>

