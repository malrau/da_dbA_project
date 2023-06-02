<html>
	<head>
		<title>
			Webapp - writer deletion page
		</title>
	</head>

	<body>
		<?php				
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can delete data <br> for your comic books writers</h2>";
			echo "</center>";
			echo "</p>";

			# query the writer table for all results
			$sql = "SELECT firstName, lastName, pseudonym FROM writer";

			# check if writer table is empty
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					/* if writer table is not empty create one form 
					   to choose one of the writers already in the
					   database to be removed */
					echo "<p>";
					echo "<h4>Select writer</h4>";
					echo "<form method = 'post' action = 'writer_deletion.php' id = 'delete writer'>";
					echo "<select name = 'writer'>";
					while($row = mysqli_fetch_array($result)) {
						$writer = $row[0] . ' ' . $row[1];
						echo "<option value = '$writer'>";
						echo $writer;
						echo "</option>";
					}
					echo "</select>";
					echo "<input type = 'submit' value = 'delete writer'>";
					echo "<h4>";
					echo "Notice that removing a writer referenced by<br>";
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
