<html>
	<head>
		<title>
			Update character data
		</title>
	</head>

	<body>
		<?php
			// the following line allows me to report connection errors,
			// otherwise a blank page would occur in case of errors
			mysqli_report(MYSQLI_REPORT_ERROR);

			// return settings from configuration file into an associative array
			$config = parse_ini_file('../config.ini');

			// get parameters to access MySQL from associative array and
			// assign them to PHP variables
			$servername = $config['servername'];
			$username = $config['username'];
			$password = $config['password'];
			$dbname = $config['dbname'];

			// create and check connection to MySQL
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if(!$conn) {
				echo "<h3>Cannot connect to MySQL: </h3>" . mysqli_connect_error();
				exit;
			} else {
				echo "<h3>Successfully connected to MySQL.</h3>";
			}

			// assign submitted data to PHP variables
			$character = $_POST['character'];
			echo $character;
			echo strlen($character);
			$spacePositions = array();
			
			$strLength = strlen($character);
			$i = 0;
			while($i < $strLength) {
				$spacePosition = strpos($character, ' ') + $i;
				array_push($spacePositions, $spacePosition);
				$character = substr($character, $spacePosition + 1);
				$i = $i + $spacePosition + 1;
				$strLength = strlen($character);
				echo $spacePosition . ' ';
			}
//			echo array_values($spacePositions);
//			$spacePosition = strpos($character, ' ');
//			$firstName = substr($character, 0, $spacePosition);
//			$lastName = substr($character, $spacePosition + 1);
//			echo $spacePosition, $firstName, $lastName;

		?>
	</body>
</html>
