
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<?php
		// error_reporting(E_ALL);
		// ini_set("display_errors","On");
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$data = array();
		$i = 0;
		$shopping_cart_total = 0;

		$db_session = new DB_Session();
		$database = $db_session->OpenCon();


		//delete book from shopping cart if delete button selected
		if(isset($_GET['delIsbn'])){
			foreach($_SESSION as $data){
				if($data['isbn'] == $_GET['delIsbn']){
					unset($_SESSION[$data['title']]);
					$_SESSION['shopping_cart'] -= 1;
				}
			}
		}

		//chec if quantity changed for shopping cart
		if(isset($_GET['stock'])){
			if($_GET['title'] == 'Visual C')
				$_GET['title'] .= '# 2008 How to Program';
			$_SESSION[$_GET['title']]['stock'] = $_GET['stock'];
		}

		//Check if we have enough stock for the book
		foreach($_SESSION as $data){
			if(isset($data['title'])){
				$query = "SELECT stock FROM books WHERE title='" . $data['title'] . "';";
				$result = $database->query($query);

				if(mysqli_num_rows($result) > 0){
					while($row = $result->fetch_assoc()){
						if($row['stock'] < $data['stock'])
							$_SESSION[$data['title']]['is_available'] = false;
						else
							$_SESSION[$data['title']]['is_available'] = true;

					}
				}
			}
		}

	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>

	$(document).ready(function(){
		calculate_payment();
	});

	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}

	function calculate_payment(){
		var total = 0;
		var i = 0;

		for(;;){
			if($('#quantity' + i).length == 0){
				break;
			}
			else {
				quantity = $('#quantity' + i).val();
				price = $('#price' + i).text();
				price = price.replace('$', '');
				total += Number(quantity) * Number(price);
			}
			i++
		}
		total = total.toFixed(2);
		$('#total').html('$' + total);
	}

	function check_stock(id, book_title){
		window.location.href='shopping_cart.php?stock=' + $('#' + id).val() + "&title=" + book_title;
	}

	</script>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="customer_registration.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>
			</td>
			<td align="center">
				<form id="exit" action="screen1.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
		<tr>
				<!-- <form id="recalculate" name="recalculate" action="" method="post"> -->
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<?php
							$i = 0;
							foreach ($_SESSION as $data) {
								if(isset($data['title'])){
									echo "<tr><td><button name='delete' onClick='del(" . $data['isbn'] . ")'>Delete Item </button></td>
											  <td><p>" . $data['title'] . "<br><strong>By: </strong>" . $data['Fname'] . ' ' . $data['Lname'] . "</p></td>";
									if($data['is_available'])
										echo "<td><input onchange='check_stock(\"" . 'quantity' . $i . "\"" . ",\"" . $data['title'] . "\")' id='quantity" . $i . "' type='text' style='width: 16px; height: 16px;' value='" . $data['stock'] . "'></td><td id='price" . $i . "'>" . $data['price'] . "</td></tr>";
									else
										echo "<td><input onchange='check_stock(\"" . 'quantity' . $i . "\"" . ",\"" . $data['title'] . "\")' id='quantity" . $i . "' type='text' style='width: 16px; height: 16px;' value='" . $data['stock'] . "'><span style='color: red;'>Not enough stock</span></td><td id='price" . $i . "'>" . $data['price'] . "</td></tr>";
									$i++;
								}

							}

						 ?>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
					<button name="recalculate_payment" onClick="calculate_payment()" id="payment">Recalculate Payment</button>
				<!-- </form> -->
			</td>
			<td align="center">
				&nbsp;
			</td>
			<td align="center">
				Subtotal: <span id='total'>$0</span>
			</td>
		</tr>
	</table>
</body>
