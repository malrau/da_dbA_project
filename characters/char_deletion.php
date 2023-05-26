<html>
	<head>
		<title>
			Deleted character data
		</title>
	</head>

	<body>
		<?php
			mysqli_report(MYSQLI_REPORT_ERROR);
			
			// return settings from configuration file into an associative array
			$config = parse_ini_file('../config.ini');
			// get parameters to access MySQL from associative array and
			// assign them to PHP variables
			$servername = $config['servername'];
			$username = $config['username'];
			$password = $config['password'];
			$dbname = $config['dbname'];

			// Create and check connection to MySQL
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if(!$conn) {
				echo "<h3>Cannot connect to MySQL.</h3>" . mysqli_connect_error();
				exit;
			} else {
				echo "<h3>Successfully connected to MySQL.</h3>";
			}

			// Assign submitted data to PHP variable
			$character = $_POST['character'];

			// retrieve position of the space character to separate first 
			// name and last name in $character, by applying the 
			// strpos(string, pattern) php function
			$spacePosition = strpos($character, ' ');

			// apply the substr(string, start, end) function to $artist by 
			// exploiting the position of the space character
			$firstName = substr($character, 0, $spacePosition);
			$lastName = substr($character, $spacePosition + 1);

			// perform and check deletion from the chosen query
			$sql = "DELETE FROM figure WHERE firstName = '$firstName' AND lastName = '$lastName'";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>$firstName $lastName was successfully removed from the table <i>figure</i>.</h3>";
			} else {
				echo "<h3>ERROR. Could not remove $firstName $lastName from the table <i>figure</i>.</h3>";
			}
			
		?>

		<br>

		<p>
			<a href = '_c_delete_char.php'><button>Back to the character deletion page</button></a>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>