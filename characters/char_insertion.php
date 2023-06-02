<html>
	<head>
		<title>
			Inserted character data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign submitted data to PHP variables
			$firstName = $_POST['first_name'];
			$lastName = $_POST['last_name'];
			$pseudo = $_POST['pseudo'];

			# perform and check insertion into the chosen table
			$sql = "INSERT INTO figure(firstName, lastName, pseudonym) VALUES('$firstName', '$lastName', '$pseudo')";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Data was successfully inserted into the table <i>figure</i>.</h3>";
			} else {
				echo "<h3>ERROR! Could not insert data into the table <i>figure</i>: </h3>" . mysqli_error($conn);
			}
		?>

		<br>

		<p>
			<a href = '_b_insert_char.html'><button>Back to the insert character page</button></a>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
