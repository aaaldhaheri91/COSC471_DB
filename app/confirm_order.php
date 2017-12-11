

<!DOCTYPE HTML>
<head>
	<title>Confirm Order</title>

	<?php

		error_reporting(E_ALL);
		ini_set("display_errors","On");
		session_start();
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath .'/db_session.php');

		$data = array();
		$db_session = new DB_Session();
		$database = $db_session->OpenCon();
		$total_price = 0;
		$total_stock = 0;


	?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		//remove from cart
		function del(isbn){
			window.location.href="shopping_cart.php?delIsbn="+ isbn;
		}

	</script>
</head>
<body>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center"> </td>
			<td align="center">
				<h3 align="center">Confirm Order</h3>
			</td>
			<td align="center"> </td>
		</tr>
		<tr>
			<td><strong>Shipping Address:</strong></td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['username']?></td>
			<td align="center">
				<input type="radio" checked>Use Credit Card on file</br>
				<?php echo $_SESSION['customer']['credit_card_type'] . " - " . $_SESSION['customer']['card_number'] ?>
			</td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['address'] ?></td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['city'] ?></td>
			<td align="center">
				<input type="radio">New Credit Card
			</td>
		</tr>
		<tr>
      <td><?php echo $_SESSION['customer']['state'] . ", " . $_SESSION['customer']['zip'] ?></td>
      <td></td>
	  </tr>
		<tr>
			<td></td>
			<td>
				<select>
 					 <option value="volvo">Visa</option>
					 <option value="saab">Master</option>
 					 <option value="opel">American Express</option>
				</select>
			</td>
			<td align="left"><input name="searchfor" placeholder="Enter Card Number"></td>
		</tr>

		<tr>
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<?php
						 	foreach($_SESSION as $data){
								if(isset($data['title'])){
									$data['price'] = preg_replace('/\$/', '', $data['price']);
									$total_price += $data['price'] * $data['stock'];
									$total_stock += $data['stock'];
									echo "<tr><td><p>" . $data['title'] . "<br><strong>By: </strong>" . $data['Fname'] . ' ' . $data['Lname'] . "
									<br><strong>Price:</strong> " . $data['price'] . "</p></td>
									<td>" . $data['stock'] . "</td>
									<td>$" . $data['stock'] * $data['price'] . "</td></tr>";
								}
							}
						?>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td style="background-color: #7FFFD4"><strong>SHIPPING NOTE:</strong> <br>The books will be <br>
				delivered within 5 <br> business days
			</td>
			<td></td>
			<td>
				<strong>Subtotal:</strong>$<?php echo $total_price ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Shipping:</strong>$<?php echo $total_stock * 2 ?>.00</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______</strong></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Total:</strong> $<?php echo $total_price + 4 ?></td>
		</tr>
		<tr>

			<td>
				<form action="screen2.php" method="post">
					<input id="button_submit" type="submit" value="Cancel" style="width:100px;height:30px;background-color:AntiqueWhite;" />
				</form>
			</td>

			<td>
			<form action="update_customerprofile.php" method="post">
				<input type="submit" value="Update Customer Profile" style="background-color:AntiqueWhite;"/>
			</form>
			</td>

			<td>
      <form action="purchase_proof.php"  method="post">
        <input type="submit" value="Buy It" style="width:100px;height:30px;background-color:AntiqueWhite;" />
      </form>
      </td>
		</tr>
	</table>
</body>
