
<!-- Figure 3: Search Result Screen by Prithviraj Narahari, php coding: Alexander Martens -->
<html>
<head>
	<title> Search Result - 3-B.com </title>

	<?php
		$data = array();
		$i = 0;
		$database = OpenCon();

		//query the database table and display information
		$data_temp = $database->query('SELECT * FROM Books');

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
