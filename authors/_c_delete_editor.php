<html>
	<head>
		<title>
			Webapp - editor deletion page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can delete data <br> for your comic books editors</h2>";
			echo "</center>";
			echo "</p>";

			# query the editor table for all results and store the query
			$sql = 'SELECT * FROM editor';
			$result = mysqli_query($conn, $sql);

			# query the editor table for editor names and store the query
			$sqlName = 'SELECT name FROM editor';
			$resultName = mysqli_query($conn, $sqlName);

			# query the editor table for editor cities and store the query
			$sqlCity = 'SELECT DISTINCT city FROM editor';
			$resultCity = mysqli_query($conn, $sqlCity);

			# check if editor table is empty
			if($result) {
				if(mysqli_num_rows($result) > 0) {
					/* if editor table is not empty create one form with two selects,
					   one to select editor name, the other to select editor city */

					# editor name
					echo "<p>";
					echo "<h4>Select editor</h4>";
					echo "<form method = 'post' action = 'editor_deletion_name.php' id = 'delete editor'>";
					echo "<select name = 'editorName'>";
					while($rowName = mysqli_fetch_array($resultName)) {
						echo "<option value = '$rowName[0]'>";
						echo $rowName[0];
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'delete editor'>";
					echo "<h4>";
					echo "Notice that removing an editor referenced by<br>";
					echo "another table will violate an integrity (foreign key)<br>";
					echo "constraint and will throw an error message";
					echo "</h4>";
					echo "</form>";
					echo "</p>";
					echo "<br>";

					# editor city
					echo "<p>";
					echo "<h4>Select editor's city</h4>";
					echo "<h5>Caution! This will remove all editors based in the city you inputted!</h5>";
					echo "<form method = 'post' action = 'editor_deletion_city.php' id = 'submit city'>";
					echo "<select name = 'editorCity'>";
					while($rowCity = mysqli_fetch_array($resultCity)) {
						echo "<option value = '$rowCity[0]'>";
						echo $rowCity[0];
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'submit city'>";
					echo "<h4>";
					echo "Notice that removing an editor referenced by<br>";
					echo "another table will violate an integrity (foreign key)<br>";
					echo "constraint and will throw an error message";
					echo "</h4>";
					echo "</form>";
					echo "</p>";
					
					mysqli_free_result($result);
				} else {
					echo "<h4>No matching records are found.</h4>";
				}
			} else {
				echo "<h3></h3>ERROR. Cannot execute $sql.</h3>" . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
