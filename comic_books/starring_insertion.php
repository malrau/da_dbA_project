<html>
	<head>
		<title>
			Inserted starring data
		</title>
	</head>
	
	<body>
		<?php
			# exploit script to perform MySQL connection (commented, at the moment)
			# include('../connect.php');
			
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
			
			// assign data to PHP variables
			$cbID = $_POST['cbID'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			#echo $cbID;
			#echo $city;
			#echo $country;

			foreach($_POST as $key => $value) {
				if($dashPosition = strpos($key, '-')) {
					$pseudoKey = substr($key, 0, $dashPosition);
					/*  note that $pseudoKey, within the $_POST array is
						key and value at the same time */
					$pseudonym = $_POST[$pseudoKey];
					# echo "PSEUDO " . $pseudonym;
					$tempRole = substr($key, $dashPosition + 1);
					/*	I reconstruct the role key to retrieve the corresponding
						value from the $_POST array */
					$figureRole = $_POST[$pseudoKey . '-' . $tempRole];
					# echo "ROLE " . $figureRole;
					# perform insertion into 'starring' for each character
					$sql = "INSERT INTO starring(comic_bookID, figure, figureRole, city, country) VALUES('$cbID', '$pseudonym', '$figureRole', '$city', '$country')";
					if(mysqli_query($conn, $sql)) {
						echo "<h3>Data was successfully inserted into the <i>starring</i> table.</h3>";
					} else {
						echo "<h3>ERROR! Could not insert data into the <i>starring</i> table: </h3>" . mysqli_error($conn);
					}
				} else {
					echo "<h3>No character and role data found.</h3>";
				}
			}
			


		?>
	</body>
</html>
