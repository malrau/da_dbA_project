<html>
	<head>
		<title>
			Query editors
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data and query to PHP variables
			$editor = $_POST['editor'];
			$sql = "SELECT DISTINCT E.name AS 'Editor', C.series AS 'Series'
					FROM   (editor AS E JOIN publishing AS P ON E.name = P.editor)
						   JOIN comic_book AS C ON P.comic_bookID = C.cbID
					WHERE  E.name = '$editor'";
			$result = mysqli_query($conn, $sql);

			echo "<h4>$editor publishes the following comic book series:</h4>"; 
			# print a table to display the query result
			echo "<table border = '1'>";

			# print the table fields names
			$fInfo = mysqli_fetch_fields($result);
			echo "<tr>";
			foreach($fInfo as $val) {
				echo "<th>";
				echo $val -> name;
				echo "</th>";
			}
			echo "</tr>";

			# print the table content
			while($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				foreach($row as $field => $value) {
					echo "<td>";
					echo $value;
					echo "</td>";
				}
				echo "</tr>";
			}

			echo "</table>";
		?>

		<br>

		<p>
			<a href = '_e_query_editor.php'><button>Back to the query editor page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
