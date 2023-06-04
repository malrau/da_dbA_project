<html>
	<head>
		<title>
			Webapp - comic book update page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can update data <br> in your comic books collection</h2>";
			echo "</center>";
			echo "</p>";

			# query the comic_book table for all results
			$sql = "SELECT * FROM comic_book";

			# check that the above defined query can be performed
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					/* if the query result is not empty (there is data
					   in the comic_book table), create a form to: */

					# 1) check the comic book data that need be updated
					echo "<h4>Check the comic book data that you want to update:</h4>";
					echo "<form method = 'post' action = 'cb_update.php'>";
					echo "<p>";
					echo "<select name = 'comic_book'>";
					while($row = mysqli_fetch_array($result)) {
						$comic_book = $row[1] . ' No. ' . $row[2] . ' - ' . $row[3];
						echo "<option value = '$comic_book'>";
						echo $comic_book;
						echo "</option>";
					}
					echo "</select>";
					echo "</p>";
					echo "<br>";

					# 2) choose the attribute you want to update
					echo "<p>";
					echo "Choose the comic book attribute you want to update: ";
					echo "<input type = 'radio' name = 'attribute' value = 'series'>series; ";
					echo "<input type = 'radio' name = 'attribute' value = 'issueNumber'>issue number; ";
					echo "<input type = 'radio' name = 'attribute' value = 'coverTitle'>cover title";
					echo "</p>";

					# 3) indicate old and new value for the chosen attribute
					echo "<p>";
					echo "Insert the old value for the selected attribute: ";
					echo "<input type = 'text' name = 'old'>";
					echo "<br>";
					echo "Insert the new value for the selected attribute: ";
					echo "<input type = 'text' name = 'new'>";
					echo "</p>";

					echo "<p>";
					echo "<input type = 'submit' value = 'update data'>";
					echo "<input type = 'reset' value = 'reset fields'>";
					echo "</p>";
					echo "<h4>";
					echo "Notice that issue number and cover title are not<br>";
					echo "unique across the comic_book table, so updating them<br>";
					echo "may result in processing unwanted changes";
					echo "</h4>";
					echo "</form>";
				} else {
					echo "<h4>No matching records are found</h4>";
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
