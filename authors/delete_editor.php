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
				echo "<h2>In this page you can delete data for your comic books editors</h2>";
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
				} else {
					echo "<h3>Successfully connected to MySQL.</h3>\n";
				}

				$sql = 'SELECT name FROM editor';
				$result = mysqli_query($conn, $sql);
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						echo "<form method = 'post' action = 'editor_deletion.php'>";
						echo "<select name = 'editor'>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<option value = '$row[0]'>";
							echo $row[0];
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit choice'>";
						echo "</form>";
						
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
