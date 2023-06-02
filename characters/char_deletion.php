<html>
	<head>
		<title>
			Deleted character data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# Assign submitted data to PHP variable
			$character = $_POST['character'];

			/* retrieve position of the space character to separate first 
			   name and last name in $character, by applying the 
			   strpos(string, pattern) php function */
			$spacePosition = strpos($character, ' ');

			/* apply the substr(string, start, end) function to $artist by 
			   exploiting the position of the space character */
			$firstName = substr($character, 0, $spacePosition);
			$lastName = substr($character, $spacePosition + 1);

			# perform and check deletion from the chosen table
			$sql = "DELETE FROM figure WHERE firstName = '$firstName' AND lastName = '$lastName'";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>$firstName $lastName was successfully removed from the table <i>figure</i>.</h3>";
			} else {
				echo "<h3>ERROR. Could not remove $firstName $lastName from the table <i>figure</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_c_delete_char.php'><button>Back to the character deletion page</button></a>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
