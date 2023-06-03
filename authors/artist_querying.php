<html>
	<head>
		<title>
			Query artists
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data to PHP variable
			$artist = $_POST['artist'];
			
			/* $artist has two elements: the artist's first name and the
			   artist's last name. I need to separate them by retrieving
			   the position of the space that separates the first name
			   from the last name */
			$spacePosition = strpos($artist, ' ');
			$firstName = substr($artist, 0, $spacePosition);
			$lastName = substr($artist, $spacePosition + 1);

			# assign query to PHP variable
			$sql = "SELECT D.firstName AS 'First name', D.lastName AS 'Last name',
						   C.series AS 'Series', C.issueNumber AS 'Issue',
						   C.coverTitle AS 'Title'
					FROM   (artist AS D JOIN authoring AS A ON D.artistID = A.artistID)
						   JOIN comic_book AS C ON A.comic_bookID = C.cbID
					WHERE  D.firstName = '$firstName' AND D.lastName = '$lastName'";
			$result = mysqli_query($conn, $sql);

			echo "<h4>$firstName $lastName has drawn the following comic books:</h4>"; 
			# print a table to display the query result
			echo "<table border = '1'>";

			# print the table fields names
			$fInfo = mysqli_fetch_fields($result);
			echo "<tr>";
			foreach($fInfo as $val) {
				echo "<th>";
				echo $val -> name;
				echo "</th>";
			}
			echo "</tr>";

			# print the table content
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
			<a href = '_e_query_artist.php'><button>Back to the query artist page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
