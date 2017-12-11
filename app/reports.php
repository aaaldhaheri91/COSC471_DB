<html>
<head>
	<title>Reports</title>
	<style>
	</style>
</head>
<body>
	<?php		
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$db_session = new DB_Session();
		$database = $db_session->OpenCon();
		
		$data = $database->query("SELECT count(*) FROM users");
		$row = $data->fetch_assoc();
		$num_users = $row['count(*)'];
/*		
		$data = $database->query("SELECT category, count(category) FROM `books` GROUP BY category")
					
			echo "<table><tr><td>Stock Report</td></tr>";
			
			while($row = $data->fetch_assoc()) {
						echo "<tr><td>" . $row['category'] . "</td><td>" . $row['count(category)'] . "</td></tr>";
			}
			echo "</table>";
*/
	?>		
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Customer Report</td>
		</tr>
		<tr>
			<td align='center'>Total number of customers till date</td>
			<td align='center'><?php echo $num_users;?></td>
		</tr>
	</table>
	
	<br>
	<br>
	<br>
	
	
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>27.625000000000004</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>13.007407407407406</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>50.5</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>18.7</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>6.7727272727272725</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>7.45</td>
		</tr>
	</table>
	<table align='center' border='2' style='border:2px solid blue;'>
		<tr>
			<td align='center' colspan='2'>Sales Report</td>
		</tr>
		<tr>
			<td align='center'>Sales average till date</td>
			<td align='center'>47.3625</td>
		</tr>
	</table>
	<form action='screen1.php' method='post' align='center'>
		<input type='submit' name='cancel' value='EXIT 3-B.com[Admin]'>
	</form>
</body>
</html>

