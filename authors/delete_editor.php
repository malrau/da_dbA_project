<html>
	<head>
		<title>
			Webapp - editor deletion page
		</title>
	</head>

    	<body>
		<p>
			<?php
				echo "<p>";
				echo "<center>";
				echo "<h2>In this page you can delete data <br> for your comic books editors</h2>";
				echo "</center>";
				echo "</p>";

				mysqli_report(MYSQLI_REPORT_ERROR);

				$config     = parse_ini_file('../config.ini');
				$servername = $config['servername'];
				$username   = $config['username'];
				$password   = $config['password'];
				$dbname     = $config['dbname'];

				$conn = mysqli_connect($servername, $username, $password, $dbname);
				if(!$conn) {
					echo "<h3>Cannot connect to MySQL.</h3>" . mysqli_connect_error();
					exit;
				} // else {
//					echo "<h3>Successfully connected to MySQL.</h3>\n";
//				} 
// the above three lines are commented because I don't want this message to be shown in the page where the query is set

				// query the editor table for all results and store the query
				$sql = 'SELECT * FROM editor';
				$result = mysqli_query($conn, $sql);

				// query the editor table for editor names and store the query
				$sqlName = 'SELECT name FROM editor';
				$resultName = mysqli_query($conn, $sqlName);

				// query the editor table for editor cities and store the query
				$sqlCity = 'SELECT DISTINCT city FROM editor';
				$resultCity = mysqli_query($conn, $sqlCity);

				// check if editor table is empty
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						// if editor table is not empty create one form with two selects,
						// one to select editor name, the other to select editor city
						
						
						// editor name
						echo "<p>";
						echo "<h4>Delete editor by name</h4>";
						echo "<form method = 'post' action = 'editor_name_deletion.php' id = 'submit name'>";
						echo "<select name = 'editorName'>";
						while($rowName = mysqli_fetch_array($resultName)) {
							echo "<option value = '$rowName[0]'>";
							echo $rowName[0];
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit name'>";
						echo "</form>";
						echo "</p>";
						echo "<br>";
						// editor city
						echo "<p>";
						echo "<h4>Delete editor by city</h4>";
						echo "<h5>Caution! This will remove all editors based in the city you inputted!</h5>";
						echo "<form method = 'post' action = 'editor_city_deletion.php' id = 'submit city'>";
						echo "<select name = 'editorCity'>";
						while($rowCity = mysqli_fetch_array($resultCity)) {
							echo "<option value = '$rowCity[0]'>";
							echo $rowCity[0];
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit city'>";
						echo "</form>";
						echo "</p>";
						
						mysqli_free_result($result);
					} else {
						echo "<h3>No matching records are found.</h3>";
					}
				} else {
					echo "<h3></h3>ERROR. Cannot execute $sql.</h3>" . mysqli_error($conn);
				}
			?>

		</p>

		<br>

		<p>
			<a href = 'authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    	</body>
</html>
