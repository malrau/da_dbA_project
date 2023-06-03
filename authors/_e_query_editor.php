<html>
	<head>
		<title>
			Webapp - editor queries page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can run a few preset queries <br> for the editors in your comic books collection</h2>";
			echo "</center>";
			echo "</p>";

			/* retrieve editors in the database by MySQL query to be 
			   used within select control element in the following form */ 
			$sql = "SELECT * FROM editor";

			echo "<br>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					# this form shows the series published by the selected editor
					echo "<p>";
					echo "<h4>Show the comic book series published by the selected editor:</h4>";
					echo "<form method = 'post' action = 'editor_querying.php' id = 'show series'>";
					echo "<select name = 'editor'>";
					while($row = mysqli_fetch_array($result)) {
						echo "<option value = '$row[0]'>";
						echo $row[0];
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'show series'>";
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
