<html>
	<header>
		<title>
			Webapp - character deletion page
		</title>
	</header>
	
	<body>
		<p>
			<?php
				echo "<p>";
				echo "<center>";
				echo "<h2>In this page you can delete comic book characters <br> in your database</h2>";
				echo "</center>";
				echo "</p>";

				# exploit script to perform MySQL connection
				include('../connect.php');
				
				/* define query to retrieve all results from the table 
				   figure and store the query result */
				$sql = "SELECT * FROM figure";
				
				// check if figure table is empty
				if($result = mysqli_query($conn, $sql)) {
					if(mysqli_num_rows($result) > 0) {
						/* if figure table is not empty create a form to
						   select the character by first name and last name */
						echo "<p>";
						echo "<h4>Delete character</h4>";
						echo "<form method = 'post' action = 'char_deletion.php' id = 'submit character'>";
						echo "<select name = 'character'>";
						while($row = mysqli_fetch_array($result)) {
							$character = $row[0] . ' ' . $row[1]; # value to be passed to the 'post' array
							$charPseudo = $row[0] . ' ' . $row[1] . ' ' . '(' . $row[2] . ')'; # value to be shown in the drop down menu
							echo "<option value = '$character'>";
							echo $charPseudo;
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit character'>";
						echo "</form>";
						echo "</p>";
						mysqli_free_result($result);
					} else {
						echo "<h3>No matching records are found.</h3>";
					}
				} else {
					echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
				}
			?>
		</p>
		
		<br>
		
		<p>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
