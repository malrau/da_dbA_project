<html>
	<head>
		<title>
			Updated artist data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data to PHP variables
			$artist = $_POST['artist'];	// VARIABLE NOT USED
			$attribute = $_POST['attribute'];
			$old = $_POST['old'];
			$new = $_POST['new'];

			
			$sql = "UPDATE artist SET $attribute = '$new' WHERE $attribute = '$old'";
			
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Attribute <i>$attribute</i> from table <i>artist</i> has been successfully updated.</h3>";
			} else {
				echo "<h3>Could not update attribute $attribute from table <i>artist</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_d_update_artist.php'><button>Back to the update artist page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
			
		</p>
	</body>
</html>
