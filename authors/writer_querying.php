<html>
	<head>
		<title>
			Query writers
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data to PHP variable
			$writer = $_POST['writer'];
			
			/* $writer has two elements: the writer's first name and the
			   writer's last name. I need to separate them by retrieving
			   the position of the space that separates the first name
			   from the last name */
			$spacePosition = strpos($writer, ' ');
			$firstName = substr($writer, 0, $spacePosition);
			$lastName = substr($writer, $spacePosition + 1);

			# assign query to PHP variable
			$sql = "SELECT W.firstName AS 'First name', W.lastName AS 'Last name',
						   C.series AS 'Series', C.issueNumber AS 'Issue',
						   C.coverTitle AS 'Title'
					FROM   (writer AS W JOIN authoring AS A ON W.writerID = A.writerID)
						   JOIN comic_book AS C ON A.comic_bookID = C.cbID
					WHERE  W.firstName = '$firstName' AND W.lastName = '$lastName'";
			$result = mysqli_query($conn, $sql);

			echo "<h4>$firstName $lastName has written the following comic books:</h4>"; 
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
			<a href = '_e_query_writer.php'><button>Back to the query writer page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
