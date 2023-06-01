<html>
	<head>
		<title>
			Webapp - artist deletion page
		</title>
	</head>

    	<body>
		<p>
			<?php
				echo "<p>";
				echo "<center>";
				echo "<h2>In this page you can delete data <br> for your comic books artists</h2>";
				echo "</center>";
				echo "</p>";

				# exploit script to perform MySQL connection
				include('../connect.php');

				# query the artist table for all results
				$sql = 'SELECT firstName, lastName, pseudonym FROM artist';

				// check if artist table is empty
				if($result = mysqli_query($conn, $sql)) {
					if(mysqli_num_rows($result) > 0) {
						/* if artist table is not empty create one form 
						   to choose one of the artists already in the
						   database to be removed */
						echo "<p>";
						echo "<h4>Select artist</h4>";
						echo "<form method = 'post' action = 'artist_deletion.php' id = 'delete artist'>";
						echo "<select name = 'artist'>";
						while($row = mysqli_fetch_array($result)) {
							$artist = $row[0] . ' ' . $row[1];
							echo "<option value = '$artist'>";
							echo $artist;
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'delete artist'>";
						echo "<h4>";
						echo "Notice that removing an artist referenced by<br>";
						echo "another table will violate an integrity (foreign key)<br>";
						echo "constraint and will throw an error message";
						echo "</h4>";
						echo "</form>";
						echo "</p>";
						mysqli_free_result($result);
					} else {
						echo "<h4>No matching records are found.</h4>";
					}
				} else {
					echo "<h3></h3>ERROR. Cannot execute $sql.</h3>" . mysqli_error($conn);
				}
			?>
		</p>

		<br>

		<p>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    	</body>
</html>
