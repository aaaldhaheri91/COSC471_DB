
<!-- screen 4: Book Reviews by Prithviraj Narahari, php coding: Alexander Martens-->
<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>

<?php
	error_reporting(E_ALL);
	ini_set("display_errors","On");
	session_start();
	$filepath = realpath(dirname(__FILE__));
	require_once($filepath .'/db_session.php');

	$data = array();
	$data_temp = array();
	$i = 0;
	$db_session = new DB_Session();
	$database = $db_session->OpenCon();

	//query the database table and display information
	$data_temp = $database->query('SELECT * FROM reviews NATURAL JOIN books WHERE isbn = ' . $_GET['isbn']);
	if(mysqli_num_rows($data_temp) == 0)
		$data_temp = $database->query('SELECT * FROM books WHERE isbn = ' . $_GET['isbn']);

	while($row = $data_temp->fetch_assoc()){
		$data[$i] = $row;
		$i++;
	}


?>

<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
</style>
<script>

	function redirect_search_result(isbn, searchfor, searchon, category){
		window.location.href="screen3.php?searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;
	}

</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<h5> <?php echo $data[0]['title'];?></h5>
			</td>
		</tr>

		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table>
			<tr>
				<p></p>
			</tr>
			<tr><p><?php
							if(isset($data[0]['description']))
							 	echo $data[0]['description'];
							else
							 	echo "No reviews";

					?></p>
			</tr>
		</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<?php
						echo "<button onClick='redirect_search_result(" . $_GET['isbn'] . ',"' . $_GET['searchfor'] . '","' . $_GET['searchon'] . '","' . $_GET['category'] . '"' . ")'>Done</button>";

				 ?>
			</td>
		</tr>
	</table>

</body>

</html>
