<html>
	<head>
		<title>
			Update character data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign submitted data to PHP variables
			$character = $_POST['character']; // VARIABLE NOT USED
			$attribute = $_POST['attribute'];
			$old = $_POST['old'];
			$new = $_POST['new'];

			/* retrieve position of the space character to separate first 
			   name and last name in $character, by applying the 
			   strpos(string, pattern) php function */
			$spacePosition = strpos($character, ' ');				// VARIABLE NOT USED
			
			/* apply the substr(string, start, end) function to $character
			   by exploiting the position of the space character */
			$firstName = substr($character, 0, $spacePosition);		// VARIABLE NOT USED
			$lastName = substr($character, $spacePosition + 1);		// VARIABLE NOT USED
			
			# perform and check update on the chosen table
			$sql = "UPDATE figure SET $attribute = '$new' WHERE $attribute = '$old'";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Attribute $attribute from table <i>figure</i> has been successfully updated.</h3>";
			} else {
				echo "<h3>Could not update attribute $attribute from table <i>figure</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_d_update_char.php'><button>Back to the update character page</button></a>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
