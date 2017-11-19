
<!-- Figure 2: Search Screen by Alexander -->
<html>
<head>
	<title>SEARCH - 3-B.com</title>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
	//disables search button unitl user enters text
	$(document).ready(function(){
		$('#submitButton').attr('disabled', true);
		$('#message').keyup(function (){
			if($(this).val.length != 0)
				$('#submitButton').attr('disabled', false);
			else {
				$('#submitButton').attr('disabled', true);
			}
		})
	});
</script>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
			<form action="screen3.php" method="get">
				<td><input id="message" name="searchfor" /></td>
				<td><input id="submitButton" type="submit" name="search" value="Search" /></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select name="searchon[]" multiple>
						<option value="anywhere" selected='selected'>Keyword anywhere</option>
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="publisher">Publisher</option>
						<option value="isbn">ISBN</option>
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select name="category">
						<option value='all' selected='selected'>All Categories</option>
						<option value='OOP'>OOP</option><option value='Procdural Programming'>Proceudral Programming</option><option value='Database'>Database</option>
					</select>
				</td>
				</form>
				<form action="screen1.php" method="post">
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
</html>
