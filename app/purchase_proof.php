


<!DOCTYPE HTML>
<head>
	<title>Proof of Purchase</title>
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
				<h3 align="center">Proof of Purchase</h3>
			</td>
			<td align="center"> </td>
		</tr>
		<tr>
			<td><strong>Shipping Address:</strong></td>		
			<td></td>
			<td><strong>UserID:</strong>&lt;username&gt;</td>
		</tr>	
		<tr>
			<td>&lt;Customer Name&gt;</td>
			<td></td>
			<td><strong>Date:</strong>MM/DD/YY</td>
		</tr>
		<tr>
			<td>&lt;Street Address&gt;</td>
			<td></td>
			<td><strong>Time:</strong>HH:MM:SS</td>
		</tr>	
		<tr>
			<td>&lt;City&gt;</td>
		</tr>
		<tr>
                        <td>&lt;State&gt; &nbsp;  &lt;ZIP code&gt;</td>
			<td></td>
			<td><strong>Credit Card Information:</strong></td>
                </tr>	
		
		<tr>
				<form id="recalculate" name="recalculate" action="" method="post">
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
											</table>
				</div>
			</td>
		</tr>
		<tr>
			<td><strong>SHIPPING NOTE:</strong></td>
			<td></td>
			<td><strong>Subtotal: </strong></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Shipping:</strong></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;______</strong></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><strong>Total:</strong></td>
		</tr>
		<tr>
			<td>
			<form action="" method="post">
				<input type="submit" value="Print" style="width:100px;height:30px;background-color:AntiqueWhite;" />
			</form>
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
</body>



