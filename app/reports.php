<html>
<head>
	<title>Reports</title>
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
		$num_users = $row['count(*)'] - 1;
		
					
		echo "<table align='center' border='2' style='border:2px solid blue;'><tr><td  align='center' colspan='2'>Stock Report</td></tr>";
			
		$result = get_stock($database);

		while($row = $result->fetch_assoc()) {
			echo "<tr><td align='center'>" . $row['category'] . "</td><td align='center'>" . $row['count(category)'] . "</td></tr>";
		}

		echo "</table>";


//Calculate Monthly Totals-------------------------------------------------------------------------

		

		$result = get_totals($database);

		if(!$result) {
			echo "Error:" . $database->error;
		}

		$sum = 0;
		$divisor = 0;
		$total = array();

		while($row = $result->fetch_assoc()) {

			$month = (int)substr($row['order_date'], 5, 2);

			$total[$month] = ((float)substr($row['total'], 1) + $total[$month]);

		}


		for($i = 0; $i < 12; $i++) {
				if($total[$i] != 0) {
					$sum = $sum + $total[$i];
					$divisor = $divisor + 1;
				}
			}

		$monthly_ave = $sum / $divisor; 

		echo "<table align='center' border='2' style='border:2px solid blue;'>
			<tr>
				<td  align='center' colspan='2>Sales Report</td>
			</tr>
			<tr>
				<td  align='center'>Monthly Average</td>
				<td  align='center'>" . $monthly_ave . "</td>
			</tr>
		</table>";

//Calculate The Number of Reviews------------------------------------------------------------------

		$result = get_review_num($database);

		echo "<table align='center' border='2' style='border:2px solid blue;'><tr><td  align='center' colspan='2'>Book Report</td></tr>";
			
		$result = get_stock($database);


		while($row = $result->fetch_assoc()) {
			echo "<tr><td align='center'>" . $row['title'] . "</td><td align='center'>" . $row['count(category)'] . "</td></tr>";
		}

		echo "</table>";

	

//Functions----------------------------------------------------------------------------------------

		/**
		* This returns an associative array of the books table
		* @return result is the associative array
		*/
		function get_stock($conn){
			$query = "SELECT *, count(category) FROM books GROUP BY category";

			return $conn->query($query);
		}


		/**
		* This returns an associative array of the books table
		* @return result is the associative array
		*/
		function get_totals($conn){
			$query = "SELECT * FROM orders WHERE order_date >= '2017-01-01'";

			return $conn->query($query);
		}

		/**
		* This returns an associative array of the books table
		* @return result is the associative array
		*/
		function get_titles($conn){
			$query = "SELECT * FROM books WHERE order_date >= '2017-01-01'";

			return $conn->query($query);
		}


		/**
		* This returns an associative array of the books table
		* @return result is the associative array
		*/
		function get_review_num($conn){
			$query = "SELECT title, num_rev FROM books NATURAL JOIN (SELECT isbn, count(isbn) AS num_rev FROM reviews GROUP BY isbn) AS temp";

			return $conn->query($query);
		}

	//	SELECT *, count(isbn) FROM reviews NATURAL JOIN books GROUP BY reviews.isbn 
		//<td align='center'>" . $row2['count(isbn)'] . "</td>
	//	$result2 = $conn->query("SELECT *, count(isbn) FROM reviews GROUP BY isbn");
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

	<form action='screen1.php' method='post' align='center'>
		<input type='submit' name='cancel' value='EXIT 3-B.com[Admin]'>
	</form>
</body>
</html>

