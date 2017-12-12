


<!DOCTYPE HTML>
<head>
	<title>Proof of Purchase</title>
	<?php

			// error_reporting(E_ALL);
			// ini_set("display_errors","On");
			session_start();
			$filepath = realpath(dirname(__FILE__));
			require_once($filepath .'/db_session.php');

			$db_session = new DB_Session();
			$database = $db_session->OpenCon();
			$total_price = 0;
			$total_stock = 0;
			$price = 0;

			foreach($_SESSION as $data){
				if(isset($data['title'])){
					$data['price'] = preg_replace('/\$/', '', $data['price']);
					$price += $data['price'] * $data['stock'];
				}
			}

			$database->query("INSERT INTO orders (username, order_date, total)
												VALUES('" . $_SESSION['customer']['username'] . "','" . strftime('%D') . "','" . "$" . $price . "');");
			$id = $database->insert_id;

			foreach($_SESSION as $data){
				if(isset($data['title'])){
					$database->query("INSERT INTO order_items (order_num, isbn, quantity)
														VALUES('" . $id . "','" . $data['isbn'] . "','" . $data['stock'] . "');");
				}
			}

			$date = strftime('%D');
			$result = substr($date, 0, 2);

			$database->query("UPDATE purchase_history SET total= total + " . $price . " WHERE month_id='" . $result . "';");

	 ?>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}

	function print_page(){
		window.print();
		console.log("hello");
	}
	</script>
	<style>
		@media print {
			 #book_table {
				display: block;
				width: auto;
				height: auto;
				overflow: visible;
			 }
		 }
	</style>
</head>
<body>

	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center"> </td>
			<td align="center">
				<h3 align="center">Proof of Purchase</h3>
			</td>
			<td align="center"> </td>
		</tr>
		<tr>
			<td><strong>Shipping Address:</strong></td>
			<td></td>
			<td><strong>UserID:</strong><?php echo $_SESSION['customer']['username']?></td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['firstname']?></td>
			<td></td>
			<td><strong>Date:</strong><?php echo strftime('%D')?></td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['address']?></td>
			<td></td>
			<td><strong>Time:</strong>
				<?php date_default_timezone_set('US/Eastern');
							$currenttime = date('h:i:s');
							echo $currenttime;
				?>
			</td>
		</tr>
		<tr>
			<td><?php echo $_SESSION['customer']['city']?></td>
		</tr>
		<tr>
      <td><?php echo $_SESSION['customer']['state'] . ","; ?> &nbsp;  <?php echo $_SESSION['customer']['zip']; ?></td>
			<td><strong>Credit Card Information:</strong></td>
			<td><?php echo $_SESSION['customer']['credit_card_type'] . " - " . $_SESSION['customer']['card_number']?></td>
    </tr>

		<tr>
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table id="book_table" align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
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

				<!-- <input type="submit" onsubmit="print_page()" value="Print" style="width:100px;height:30px;background-color:AntiqueWhite;" /> -->
				<button style="width:100px;height:30px;background-color:AntiqueWhite;" onclick="print_page()">Print</button>

			</td>

			<td>
			<form action="screen2.php" method="post">
				<input type="submit" value="New search" style="background-color:AntiqueWhite;"/>
			</form>
			</td>

			<td>
        <form action="screen1.php" method="post">
                <input type="submit" value="Exit 3-B.com" style="width:100px;height:30px;background-color:AntiqueWhite;" />
        </form>
      </td>
		</tr>
	</table>

	<?php

		foreach($_SESSION as $data){
			if(isset($data['title'])){
				unset($_SESSION[$data['title']]);
			}
		}

	?>
</body>
