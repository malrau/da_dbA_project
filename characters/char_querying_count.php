<html>
	<head>
		<title>
			Query characters
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data and query to PHP variables
			$character = $_POST['character'];
			$sql = "SELECT F.pseudonym AS 'Character', COUNT(*) AS 'No. of appearances'
					FROM   (figure AS F JOIN starring AS S ON F.pseudonym = S.figure)
						   JOIN comic_book AS C ON S.comic_bookID = C.cbID
					WHERE  F.pseudonym = '$character'";
			$result = mysqli_query($conn, $sql);

			echo "<br>";

			# show a message to present the result
			echo "<h4>$character has appeared in the following number of comic books:</h4>";

			# print a table to display the query results
			echo "<table border = '1'";
			
			# print the table fields names
			$fInfo = mysqli_fetch_fields($result);
			echo "<tr>";
			foreach($fInfo as $val) {
				echo "<th>";
				echo $val -> name;
				echo "</th>";
			}
			echo "</tr>";
			
			#print the table content
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				foreach($row as $field => $value) {
					echo "<td>";
					echo $value;
					echo "</td>";
				}
				echo "</tr>";
			}

			echo "</table>";
		?>

		<br>

		<p>
			<a href = '_e_query_char.php'><button>Back to the characters query page</button></a>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
