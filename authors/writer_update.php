<html>
	<head>
		<title>
			Updated writer data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data to PHP variables
			$writer = $_POST['writer'];	// VARIABLE NOT USED
			$attribute = $_POST['attribute'];
			$old = $_POST['old'];
			$new = $_POST['new'];

			
			$sql = "UPDATE writer SET $attribute = '$new' WHERE $attribute = '$old'";
			
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Attribute <i>$attribute</i> from table <i>writer</i> has been successfully updated.</h3>";
			} else {
				echo "<h3>Could not update attribute $attribute from table <i>writer</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_d_update_writer.php'><button>Back to the update writer page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
			
		</p>
	</body>
</html>
