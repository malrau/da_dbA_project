<html>
	<head>
		<title>
			Webapp - writer update page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can update data for the comic book writers <br> in your collection</h2>";
			echo "</center>";
			echo"</p>";

			# query the writer table for all results
			$sql = "SELECT * FROM writer";

			# check that the above defined query can be performed
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					/* if the query result is not empty (there is data in
					   the writer table), create a form to: */

					# 1) check the writer data that need be updated
					echo "<h4>Check the writer data you want to update:</h4>";
					echo "<form method = 'post' action = 'writer_update.php'>";
					echo "<p>";
					echo "<select name = 'writer'>";
					while($row = mysqli_fetch_array($result)) {
						# show writer pseudonym if present
						if(!$row[3]) {
							echo "<option value = '$row[1] . ' ' ' ' . $row[2]'>";
							echo $row[1] . ' ' . $row[2];
							echo "</option>";
						} else {
							echo "<option value = '$row[1] . ' ' ' ' . $row[2]'>";
							echo $row[1] . ' ' . $row[2] . ' - ' . $row[3];
							echo "</option>";
						}
					}
					echo "</select>";
					echo "</p>";
					echo "<br>";

					# 2) choose the attribute you want to update
					echo "<p>";
					echo "Choose the attribute you want to update:";
					echo "<input type = 'radio' name = 'attribute' value = 'firstName'>first name; ";
					echo "<input type = 'radio' name = 'attribute' value = 'lastName'>last name; ";
					echo "<input type = 'radio' name = 'attribute' value = 'pseudonym'>pseudonym";
					echo "</p>";

					# 3) indicate old and new value for the chosen attribute
					echo "<p>";
					echo "Insert the old value for the selected attribute: ";
					echo "<input type = 'text' name = 'old'>";
					echo "<br>";
					echo "Insert the new value for the selected attribute: ";
					echo "<input type = 'text' name = 'new'>";
					echo "</p>";
			
					echo "<input type = 'submit' value = 'submit attribute'>";
					echo "<input type = 'reset' value = 'reset fields'>";
					echo "<h4>";
					echo "Notice that first name and last name are not<br>";
					echo "unique across the writer table, so updating them<br>";
					echo "may result in processing unwanted changes";
					echo "</h4>";
					echo "</form>";
					mysqli_free_result($result);
				} else {
					echo "<h4>No matching records are found</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
