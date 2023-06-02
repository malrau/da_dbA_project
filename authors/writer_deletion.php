<html>
	<head>
		<title>
			Deleted writer data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			# assign submitted data (writer's first and last names) to php variable
			$writer = $_POST['writer'];

			/* retrieve position of the space character to separate
			   first name and last name in $writer, by applying the 
			   strpos(string, pattern) php function */
			$spacePosition = strpos($writer, ' ');
			
			/* apply the substr(string, start, end) function to $writer
			   by exploiting the position of the space character */
			$firstName = substr($writer, 0, $spacePosition);
			$lastName = substr($writer, $spacePosition + 1);
			
			# perform and check deletion from the chosen table
			$sql = "DELETE FROM writer WHERE firstName = '$firstName' AND lastName = '$lastName'";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>$firstName $lastName was successfully removed from the table <i>writer</i>.</h3>";
			} else {
				echo "<h3>ERROR Could not remove $firstName $lastName from the table <i>writer</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_c_delete_writer.php'><button>Back to the delete writer page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
