<html>
	<head>
		<title>
			Webapp - comic book queries page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
							
			/* retrieve series in the database by MySQL query to be used 
			   within select control element in the following forms */
			$sql = "SELECT DISTINCT series FROM comic_book";

			echo "<p>";
				echo "<center>";
				echo "<h2>In this page you can run a few preset queries <br> for your comic books collection</h2>";
				echo "</center>";
			echo "</p>";


			echo "<br>";
			# The first form shows a list of comic books based on the parameters passed
			echo "<form method = 'post' action = 'cb_querying_show.php' id = 'show list'>";

			echo "<p>";
			echo "<h4>Show the comic books in your whole conllection or by series:</h4>";
			echo "<input type = 'radio' name = 'show' value = 'all'>whole collection";
			echo "<br><br>";
			echo "<input type = 'radio' name = 'show' value = 'not_all' checked>choose series";
			echo "<select name = 'chosen_series_show'>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($result1 = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result1) > 0) {
					while($row1 = mysqli_fetch_array($result1)) {
						echo "<option value = '$row1[0]'>";
						echo $row1[0];
						echo "</option>";
					}
				} else {
					echo "<h4>No series in the database yet.</h4>";
				}
			} else {
				echo "<h4>ERROR. Cannot execute $sql: </h4>" . mysqli_error($conn);
			}
			echo "</select>";
			echo "</p>";

			echo "<p>";
				echo "<input type = 'submit' value = 'show list'>";
				echo "<input type = 'reset' value = 'reset fields'>";
			echo "</p>";

			echo "</form>";

			
			echo "<br>";
			# The second form counts the comic books based on the parameters passed
			echo "<form method = 'post' action = 'cb_querying_count.php' id = 'show count'>";

			echo "<p>";
			echo "<h4>Count the number of comic books in your whole collection or by series:</h4>";
			echo "<input type = 'radio' name = 'count' value = 'all'>whole collection";
			echo "<br><br>";
			echo "<input type = 'radio' name = 'count' value = 'not_all' checked>choose series";
			echo "<select name = 'chosen_series_count'>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($result2 = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result2) > 0) {
					while($row2 = mysqli_fetch_array($result2)) {
						echo "<option value = '$row2[0]'>";
						echo $row2[0];
						echo "</option>";
					}
				} else {
					echo "<h4>No series in the database yet.</h4>";
				}
			} else {
				echo "<h4>ERROR. Cannot execute $sql: </h4>" . mysqli_error($conn);
			}
			echo "</select>";
			echo "</p>";

			echo "<p>";
			echo "<input type = 'submit' value = 'show count'>";
			echo "<input type = 'reset' value = 'reset fields'>";
			echo "</p>";

			echo "</form>";

			echo "<br>";
		?>

		<br>

		<p>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '..\index.html'><button>Back to the main page</button></a>
		</p>

	</body>
</html>
