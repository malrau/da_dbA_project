<html>
	<head>
		<title>
			Webapp - character queries page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can run a few preset queries <br> for the characters in your comic books collection</h2>";
			echo "</center>";
			echo "</p>";
			
			/* retrieve characters in the database by MySQL query to be used 
			   within select control element in the following forms */
			$sql = "SELECT * FROM figure";
			
			echo "<br>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($resultShow = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($resultShow) > 0) {
					/* The first form shows the comic book issues in which
					   the selected character appears */
					echo "<p>";
					echo "<h4>Show the comic book issues in which the selected character appears:</h4>";
					echo "<form method = 'post' action = 'char_querying_show.php' id = 'show issues'>";
					echo "<select name = 'character'>";
					while($rowShow = mysqli_fetch_array($resultShow)) {
						$character = $rowShow[2];
						$charPseudo = $rowShow[0] . ' ' . $rowShow[1] . ' ' . '(' . $rowShow[2] . ')';
						echo "<option value = '$character'>";
						echo $charPseudo;
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'show comic books'>";
					# echo "<input type = 'reset' value = 'reset fields'>"; 	*** UNNECESSARY BUTTON ***
					echo "</form>";
					echo "</p>";
					mysqli_free_result($resultShow);
				} else {
					echo "<h4>No matching records are found.</h4>";
				}
			} else {
				"<h3>ERROR. Cannot execute $sql.</h3>";
			}
					
			echo "<br>";
			/* check that query can be performed and that the queried
			   table is not empty */
			if($resultCount = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($resultCount) > 0) {
					/* The second form counts the comic book issues in which
					   the selected character appears */
					echo "<p>";
					echo "<h4>Count the comic book issues in which the selected character appears:</h4>";
					echo "<form method = 'post' action = char_querying_count.php id = 'count issues'>";
					echo "<select name = 'character'>";
					while($rowCount = mysqli_fetch_array($resultCount)) {
						$character = $rowCount[2];
						$charPseudo = $rowCount[0] . ' ' . $rowCount[1] . ' ' . '(' . $rowCount[2] . ')';
						echo "<option value = '$character'>";
						echo $charPseudo;
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'count comic books'>";
					# echo "<input type = 'reset' value = 'reset fields'>"; 	*** UNNECESSARY BUTTON ***
					echo"</form>";
					echo "</p>";
					mysqli_free_result($resultCount);

				} else {
					echo "<h4>No matching records are found</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
			}
			echo "<br>";
		?>

		<br>

		<p>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
