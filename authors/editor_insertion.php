<html>
	<head>
		<title>
			Inserted editor data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign submitted data to PHP variables
			$editorName = $_POST['editor_name'];
			$editorCity = $_POST['editor_city'];

			# perform and check insertion into the chosen table
			$sql = "INSERT INTO editor(name, city) VALUES('$editorName', '$editorCity')";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Data was successfully inserted into the table <i>editor</i>.</h3>";
			} else {
				echo "ERROR! Could not insert data into the table <i>editor</i>: " . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_b_insert_editor.html'><button>Back to the insert editor page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
