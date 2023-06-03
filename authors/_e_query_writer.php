<html>
	<head>
		<title>
			Webapp - writer queries page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can run a few preset queries <br> for the writers in your comic books collection</h2>";
			echo "</center>";
			echo "</p>";

			/* retrieve writers in the database by MySQL query to be 
			   used within select control element in the following form */ 
			$sql = "SELECT * FROM writer";

			echo "<br>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					# this form shows the comic books written by the selected writer
					echo "<p>";
					echo "<h4>Show the comic books written by the selected writer:</h4>";
					echo "<form method = 'post' action = 'writer_querying.php' id = 'show comic books'>";
					echo "<select name = 'writer'>";
					while($row = mysqli_fetch_array($result)) {
						# I pass first name and last name of the writer
						$writer = $row[1] . ' ' . $row[2];
						echo "<option value = '$writer'>";
						echo $row[1] . ' ' . $row[2];
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'show comic books'>";
					echo "<input type = 'reset' value = 'reset fields'>";
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
