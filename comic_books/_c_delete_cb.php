<html>
	<head>
		<title>
			Webapp - comic book deletion page
		</title>
	</head>

	<body>
		<?php
			# eploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can submit the request <br> to remove an issue from a series you own</h2>";
			echo "</center>";
			echo "</p>";

			# define query to retrieve all series in the table comic_book
			$sql = "SELECT DISTINCT series FROM comic_book";
			
			# check that the above defined query can be performed
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					/* if the query result is not empty create a form to
					   select the series */
					echo "<p>";
					echo "<h4>Select the series from which you want to remove an issue:</h4>";
					echo "<form method = 'post' action = 'cb_deletion.php'>";
					echo "<select name = 'delete_series'>";
					while($row = mysqli_fetch_array($result)) {
						echo "<option value = '$row[0]'>";
						echo $row[0];
						echo "</option>";
					}
					echo "</select>";
					echo "</p>";

					echo "<p>";
					echo "Insert the issue number for the series you want to remove: ";
					echo "<input type = 'text' name = 'delete_issue'>";
					echo "</p>";

					echo "<p>";
					echo "<input type = 'submit' value = 'submit request'>";
					echo "<input type = 'reset' value = 'reset fields'>";
					echo "</p>";
					echo "</form>";
				} else {
					echo "<h4>No matching records are found.</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
