<html>
	<head>
		<title>
			Webapp - artist queries page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can run a few preset queries <br> for the artists in your comic books collection</h2>";
			echo "</center>";
			echo "</p>";

			/* retrieve artists in the database by MySQL query to be 
			   used within select control element in the following form */ 
			$sql = "SELECT * FROM artist";

			echo "<br>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					# this form shows the comic books drawn by the selected artist
					echo "<p>";
					echo "<h4>Show the comic books drawn by the selected artist:</h4>";
					echo "<form method = 'post' action = 'artist_querying.php' id = 'show comic books'>";
					echo "<select name = 'artist'>";
					while($row = mysqli_fetch_array($result)) {
						# I pass first name and last name of the artist
						$artist = $row[1] . ' ' . $row[2];
						echo "<option value = '$artist'>";
						echo $row[1] . ' ' . $row[2];
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'show comic books'>";
					# echo "<input type = 'reset' value = 'reset fields'>"; 	*** UNNECESSARY BUTTON ***
					echo "</form>";
					echo "</p>";
				} else {
					echo "<h4>No matching records are found</h4>";
				}
			} else {
				echo "<h3>Cannot execute $sql</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
