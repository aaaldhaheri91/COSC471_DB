
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>
<head>
	<title> Search Result - 3-B.com </title>

	<?php
		error_reporting(E_ALL);
		ini_set("display_errors","On");
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$data = array();
		$i = 0;

		$db_session = new DB_Session();
		$database = $db_session->OpenCon();

		if(isset($_GET['searchfor'])){
			if($_GET['searchon'][0] == "anywhere")
				$query = search_anywhere();
			else if($_GET['searchon'][0] == 'title')
				$query = search_title();
			else if($_GET['searchon'][0] == 'author')
				$query = search_author();
			else if($_GET['searchon'][0] == 'publisher')
				$query = search_publisher();
			else if($_GET['searchon'][0] == 'isbn')
				$query = search_isbn();

			$data = query_database($database, $query);
			var_dump($data);
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
 			 		$data_temp[$i] = $row;
 					$i++;
 				}
 			 	return $data_temp;

			}


	?>
	<script>
	//redirect to reviews page
	function review(isbn){
		window.location.href="screen4.php?isbn="+ isbn;
	}
	//add to cart
	function cart(isbn, searchfor, searchon, category){
		window.location.href="screen3.php?cartisbn="+ isbn + "&searchfor=" + searchfor + "&searchon=" + searchon + "&category=" + category;
	}
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">

					<h6> <fieldset>Your Shopping Cart has 0 items</fieldset> </h6>

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
			<tr>
				<td align='left'>
					<button name='btnCart' id='btnCart' onClick='cart("123441", "", "Array", "all")'>Add to Cart</button>
				</td>
				<td rowspan='2' align='left'>
					<?php echo $data[0]['title'] ?> </br>By <?php echo $data[0]['author'] ?></br>
					<b>Publisher:</b> <?php echo $data[0]['publisher'] ?>,</br>
					<b>ISBN:</b> <?php echo $data[0]['isbn'] ?></t> <b>Price:</b> <?php echo $data[0]['price'] ?>
				</td>
			</tr>
			<tr>
				<td align='left'><button name='review' id='review' onClick='review(<?php echo $data[0]['isbn'] ?>)'>Reviews</button>
				</td>
			</tr>
			<tr>
				<td colspan='2'><p>_______________________________________________</p></td>
			</tr>
			<tr>
				<td align='left'><button name='btnCart' id='btnCart' onClick='cart("978-0316055437", "", "Array", "all")'>Add to Cart</button>
				</td>
				<td rowspan='2' align='left'><?php echo $data[1]['title'] ?></br>By <?php echo $data[1]['author'] ?></br>
					<b>Publisher:</b> <?php echo $data[1]['publisher'] ?>,</br>
					<b>ISBN:</b> <?php echo $data[1]['isbn'] ?></t> <b>Price:</b> <?php echo $data[1]['price'] ?>
				</td>
			</tr>
				<tr>
					<td align='left'><button name='review' id='review' onClick='review(<?php echo $data[1]['isbn'] ?>)'>Reviews</button>
					</td>
				</tr>
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
				</tr> -->
				<tr>
					<td colspan='2'><p>_______________________________________________</p>
					</td>
				</tr>
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
