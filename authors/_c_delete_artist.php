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
				echo "<h2>In this page you can delete data <br> for your comic books artists</h2>";
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

				// query the artist table for all results and store the query
				$sql = 'SELECT * FROM artist';
				$result = mysqli_query($conn, $sql);

				// query the artist table for artist first names and store the query
				$sqlFirst = 'SELECT firstName FROM artist';
				$resultFirst = mysqli_query($conn, $sqlFirst);

				// query the editor table for artist last names and store the query
				$sqlLast = 'SELECT lastName FROM artist';
				$resultLast = mysqli_query($conn, $sqlLast);

				// check if artist table is empty
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						// if artist table is not empty create one form with two selects,
						// one to select editor name, the other to select editor city

						echo "<p>";
						echo "<h4>Delete artist</h4>";
						echo "<form method = 'post' action = 'artist_deletion.php' id = 'submit artist'>";
						echo "<select name = 'artist'>";
						while($row = mysqli_fetch_array($result)) {
							$artist = $row[0] . ' ' . $row[1];
							echo "<option value = '$artist'>";
							echo $artist;
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit artist'>";
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
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    	</body>
</html>
