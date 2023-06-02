<html>
	<head>
		<title>
			Webapp - character update page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can update data for the comic book characters <br> in your database</h2>";
			echo "</center>";
			echo "</p>";

			// define query to retrieve all results from the table 
			// figure and store the query result
			$sql = "SELECT * FROM figure";
			$result = mysqli_query($conn, $sql);

			// check if figure table is empty
			if($result) {
				if(mysqli_num_rows($result) > 0) {
					// if figure table is not empty create a form to

					// 1) select the character
					echo "<h4>Check the character data you want to update:</h4>";
					echo "<form method = 'post' action = 'char_update.php'>";
					echo "<p>";
					echo "<select name = 'character'>";
					while($row = mysqli_fetch_array($result)) {
						$character = $row[0] . ' ' . $row[1] . ' ' . '(' . $row[2] . ')';
						echo "<option value = '$row[0] $row[1]'>";
						echo $character;
						echo "</option>";
					}
					echo "</select>";
					echo "</p>";
					echo "<br>";

					// 2) choose the attribute to update
					echo "<p>";
					echo "Choose the attribute you want to update: ";
					echo "<input type = 'radio' name = 'attribute' value = 'firstName'>first name; ";
					echo "<input type = 'radio' name = 'attribute' value = 'lastName'>last name; ";
					echo "<input type = 'radio' name = 'attribute' value = 'pseudonym'>pseudonym";
					echo "</p>";

					// 3) indicate old and new value for the chosen attribute
					echo "<p>";
					echo "Insert the old value for the selected attribute: ";
					echo "<input type = 'text' name = 'old'>";
					echo "<br>";
					echo "Insert the new value for the chosen attribute: ";
					echo "<input type = 'text' name = 'new'>";
					echo "</p>";

					echo "<input type = 'submit' value = 'submit character'>";
					echo "<input type = 'reset' value = 'reset fields'>";
					echo "</form>";
					mysqli_free_result($result);
				} else {
					echo "<h3>No matching records are found.</h3>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
