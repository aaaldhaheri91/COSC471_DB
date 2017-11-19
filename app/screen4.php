
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>

<?php
	$data = array();
	$i = 0;
	$database = OpenCon();

	//query the database table and display information
	$data_temp = $database->query('SELECT * FROM reviews WHERE isbn = ' . $_GET['isbn']);

	while($row = $data_temp->fetch_assoc()){
		$data[$i] = $row;
		$i++;
	}

	/**
	 * makes a databse connection
	 * @return Mysqli
	 */
	 function OpenCon(){
		 $dbhost = "localhost";
		 $dbuser = "201709_471_g02";
		 $dbpass = "zNueptTgd6Kokzk1Vtia";
		 $db = "201709_471_g02";

		 $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection failed: %s\n" . $conn->connect_error);
		 return $conn;
	 }

	 /**
		* closes database Connection
		* @param $conn the database connection
		*/
	 function CloseCon($conn){
		 $conn->close();
	 }
?>

<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<h5> <?php echo $data[0]['title'] ?></h5>
			</td>
		</tr>

		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table>
			<tr>
				<p></p>
			</tr>
			<tr><p><?php echo $data[0]['description'] ?></p>
			</tr>
		</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="screen3.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>

</body>

</html>
