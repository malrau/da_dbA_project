<html>
	<head>
		<title>
			Deleted artist data
		</title>
	</head>
	
	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			# assign submitted data (artist's first and last names) to php variable
			$artist = $_POST['artist'];

			/* retrieve position of the space character to separate first 
			   name and last name in $artist, by applying the 
			   strpos(string, pattern) php function */
			$spacePosition = strpos($artist, ' ');
			
			/* apply the substr(string, start, end) function to $artist by 
			   exploiting the position of the space character */
			$firstName = substr($artist, 0, $spacePosition);
			$lastName = substr($artist, $spacePosition + 1);
			
			# perform and check deletion from the chosen table
			$sql = "DELETE FROM artist WHERE firstName = '$firstName' AND lastName = '$lastName'";

			if(mysqli_query($conn, $sql)) {
				echo "<h3>$firstName $lastName was successfully removed from the table <i>artist</i>.</h3>";
			} else {
				echo "<h3>ERROR Could not remove $firstName $lastName from the table <i>artist</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_c_delete_artist.php'><button>Back to the delete artist page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
