<html>
	<head>
		<title>
			Webapp - editor update page
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can update data for your comic book authors <br> in your collection</h2>";
			echo "</center>";
			echo"</p>";

			# 
			$sql = "SELECT * FROM editor";

			echo "<h4>Check the editor data you want to update</h4>";
			echo "<form method = 'post' action = 'editor_update.php'>";
			echo "<select name = 'editor'>";
			if($result = mysqli_query($conn, $sql)) {
				if(mysqli_num_rows($result) > 0) {
					while($row = mysqli_fetch_array($result)) {
						echo "<option value = '$row[0]'>";
						echo $row[0];
						echo "</option>";
					}
				} else {
					echo "<h4>No matching records are found</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
			}
			echo "</select>";
			echo "<input type = 'submit' value = 'submit editor'>";
			echo "<input type = 'reset' value = 'reset fields'>";
			echo "</form>";
		?>

		<br>

		<p>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
