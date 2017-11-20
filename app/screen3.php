
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>
<head>
	<title> Search Result - 3-B.com </title>

	<?php
		error_reporting(E_ALL);
		ini_set("display_errors","On");
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$data = array();
		$i = 0;
		$shopping_cart_total = 0;

		if(isset($_SESSION['shopping_cart']))
			$shopping_cart_total = $_SESSION['shopping_cart'];
		else
			$_SESSION['shopping_cart'] = 0;

		if(is_array($_GET['searchon']))
			$_GET['searchon'] = $_GET['searchon'][0];

		$db_session = new DB_Session();
		$database = $db_session->OpenCon();

		if(isset($_GET['searchfor'])){
			if($_GET['searchon'] == "anywhere")
				$query = search_anywhere();
			else if($_GET['searchon'] == 'title')
				$query = search_title();
			else if($_GET['searchon'] == 'author')
				$query = search_author();
			else if($_GET['searchon'] == 'publisher')
				$query = search_publisher();
			else if($_GET['searchon'] == 'isbn')
				$query = search_isbn();

			$data = query_database($database, $query);

		}

		//add to shopping cart
		if(isset($_GET['isbn'])){
			foreach($data as $row){
				if($row['isbn'] == $_GET['isbn']){
					$_SESSION[$row['title']]['isbn'] = $row['isbn'];
					$_SESSION[$row['title']]['title'] = $row['title'];
					$_SESSION[$row['title']]['price'] = $row['price'];
					$_SESSION[$row['title']]['Fname'] = $row['Fname'];
					$_SESSION[$row['title']]['Lname'] = $row['Lname'];
					$_SESSION[$row['title']]['publisherName'] = $row['publisherName'];
					$_SESSION['shopping_cart'] += 1;
				}
			}
		}


		/**
		* This searches based on book title, author, publisher, or isbn
		* @return query is the SQL query
		*/
		function search_anywhere(){
			$query = "SELECT * FROM books NATURAL JOIN authors
								WHERE title = '" . $_GET['searchfor'] . "'
								OR isbn = '" . $_GET['searchfor'] . "'
								OR publisherName = '" . $_GET['searchfor'] . "'
								OR Fname = '" . $_GET['searchfor'] . "'
								OR Lname = '" . $_GET['searchfor'] . "'; ";
			return $query;
		}

		/**
		* This searches based on book title
		* @return query is the SQL query
		*/
		 function search_title(){
			 $query = "SELECT * FROM books NATURAL JOIN authors
			 					 WHERE title = '" . $_GET['searchfor'] . "'; ";
			 return $query;
		 }

		 /**
 		 * This searches based on book author
 		 * @return query is the SQL query
 		 */
		 function search_author(){
			 $names = explode(' ', $_GET['searchfor']);
			 $query = "SELECT * FROM books NATURAL JOIN authors
			 					 WHERE Fname = '" . $names[0] . "' and Lname = '" . $names[1] . "';";
			 return $query;
		 }

		 /**
 		 * This searches based on book publisher
 		 * @return query is the SQL query
 		 */
		 function search_publisher(){
			 $query = "SELECT * FROM books NATURAL JOIN authors
			 					 WHERE publisherName = '" . $_GET['searchfor'] . "';";
			 return $query;
		 }

		 /**
 		 * This searches based on book isbn
 		 * @return query is the SQL query
 		 */
		 function search_isbn(){
			 $query = "SELECT * FROM books NATURAL JOIN authors
			 					 WHERE isbn = '" . $_GET['searchfor'] . "';";
			 return $query;
		 }

		 /**
		  * This function query database based on query string passed in
			* @param database is the database connection session
			* @param query is the SQL query to pass to the database
			* @return data_temp is the result of the quering the database
			*/
			function query_database($database, $query){
				$data_temp = array();
				$i = 0;

				$result = $database->query($query);
 			 	while($row = $result->fetch_assoc()){

					if(isset($_GET['isbn']))
						if($row['isbn'] == $_GET['isbn'])
							$row['button'] = true;
						else
							$row['button'] = false;
					else if(isset($_SESSION[$row['title']]))
						$row['button'] = true;
				 	else
						$row['button'] = false;

 			 		$data_temp[$i] = $row;
 					$i++;
 				}
 			 	return $data_temp;

			}


	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	//redirect to reviews page
	function review(isbn){
		window.location.href="screen4.php?isbn="+ isbn;
	}
	//add to cart
	function cart(isbn, btn_id, searchfor, searchon, category){
		$('#' + btn_id).attr('disabled', true);
		window.location.href="screen3.php?isbn=" + isbn + "&searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;
	}

	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">

					<h6> <fieldset>Your Shopping Cart has <?php echo $shopping_cart_total ?> items</fieldset> </h6>

			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="post">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>
		<tr>
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;background-color:LightBlue">
			<table>
				<?php
					if(empty($data))
						echo "<p> No results, Please try again by clicking on New Search";
					$i = 0;
					foreach($data as $row){
						if($row['button'])
							$str = 'disabled';
						else
							$str = null;
						echo "<tr>
							<td align='left'>
								<button " . $str . " name='btnCart' id='btnCart" . $i . "' onClick='cart(" . $row['isbn'] . "," . '"btnCart' . $i .'","' . $_GET['searchfor'] . '","' . $_GET['searchon'] . '","' . $_GET['category'] . '"' . ")'>Add to Cart</button>
							</td>
							<td rowspan='2' align='left'>" .
								$row['title'] . "</br>By " . $row['Fname'] . "&nbsp" . $row['Lname'] . "</br>
								<b>Publisher:</b>" . $row['publisherName'] . ",</br>
								<b>ISBN:</b>" . $row['isbn'] . "</t> <b>Price:</b>" . $row['price'] . "
							</td>
						</tr>
						<tr>
							<td align='left'><button name='review' id='review' onClick='review(" . $row['isbn'] . ")'>Reviews</button>
							</td>
						</tr>
						<tr>
							<td colspan='2'><p>_______________________________________________</p></td>
						</tr>";
						$i++;
					}
				?>

				<!-- <tr>
					<td colspan='2'><p>_______________________________________________</p>
					</td>
				</tr>
				<tr>
					<td align='left'><button name='btnCart' id='btnCart' onClick='cart("978-0345339706", "", "Array", "all")'>Add to Cart</button>
					</td>
					<td rowspan='2' align='left'>Lord of the Rings, The Fellowship of the</br>By J.R.R. Tolkien</br><b>Publisher:</b> Del Rey,</br>
						<b>ISBN:</b> 978-0345339706</t> <b>Price:</b> 8.09
					</td>
				</tr>
				<tr>
					<td align='left'><button name='review' id='review' onClick='review("978-0345339706", "Lord of the Rings, The Fellowship of the")'>Reviews</button>
					</td>
				</tr>
				<tr>
					<td colspan='2'><p>_______________________________________________</p>
					</td>
				</tr>
				<tr>
					<td align='left'><button name='btnCart' id='btnCart' onClick='cart("978-0590353427", "", "Array", "all")'>Add to Cart</button>
					</td>
					<td rowspan='2' align='left'>Harry Potter and the Sorcerer Stone</br>By J.K. Rowling</br><b>Publisher:</b> Scholastic,</br><b>ISBN:</b>
						978-0590353427</t> <b>Price:</b> 8.47
					</td>
				</tr>
				<tr>
					<td align='left'><button name='review' id='review' onClick='review("978-0590353427", "Harry Potter and the Sorcerer Stone")'>Reviews</button>
					</td>
				</tr>
				<tr>
					<td colspan='2'><p>_______________________________________________</p>
					</td>
				</tr> -->
			</table>
			</div>

			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="screen1.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
