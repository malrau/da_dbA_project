<html>
	<head>
		<title>
			Deleted editor data
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
	    
		// create and check connection to MySQL
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		if(!$conn) {
			echo '<h3>Cannot connect to Mysql</h3>' . mysqli_connect_error();
			exit;
		} else {
			echo '<h3>Successfully connected to Mysql</h3>';
		}
		
		// assign submitted data to php variables
		$editorName = $_POST['editor_name'];
		$editorCity = $_POST['editor_city'];
		
		// perform and check deletion from the chosen table
		$sql = 'DELETE FROM editor WHERE name = $editorName';

	    
		?>
	</body>
</html>
