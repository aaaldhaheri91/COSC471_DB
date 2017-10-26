

<!DOCTYPE HTML>
<head>
	<title>Confirm Order</title>
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
			<td>&lt;Customer Name&gt;</td>
			<td align="center">
				<input type="radio" checked>Use Credit Card on file
			</td> 
		</tr>
		<tr>
			<td>&lt;Street Address&gt;</td>
		</tr>	
		<tr>
			<td>&lt;City&gt;</td>
			<td align="center">
				<input type="radio">New Credit Card
			</td>
		</tr>
		<tr>
                        <td>&lt;State&gt; &nbsp;  &lt;ZIP code&gt;</td>
                        <td></td>
                </tr>
		<tr>
			<td></td>	
			<td>
				<select>
 					 <option value="volvo">Visa</option>
					 <option value="saab">Saab</option>
 					 <option value="opel">Opel</option>
 					 <option value="audi">Audi</option>
				</select>
			</td>
			<td align="left"><input name="searchfor" placeholder="Enter Card Number"></td>
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
			<form action="screen2.php" method="post">
				<input type="submit" value="Cancel" style="width:100px;height:30px;background-color:AntiqueWhite;" />
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


