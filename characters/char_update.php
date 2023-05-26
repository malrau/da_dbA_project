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
			$character = $POST['character'];

		?>
	</body>
</html>