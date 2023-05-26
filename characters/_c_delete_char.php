<html>
	<header>
		<title>
			Webapp - character deletion page
		</title>
	</header>
	
	<body>
		<p>
			<?php
				echo "<p>";
				echo "<center>";
				echo "<h2>In this page you can delete comic book characters <br> in your database</h2>";
				echo "</center>";
				echo "</p>";

				mysqli_report(MYSQLI_REPORT_ERROR);
				
				// return settings from configuration file into an associative array
				$config = parse_ini_file('../config.ini');
				// retrieve parameters to access MySQL from associative array and
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
				} // else {
//					echo "<h3>Successfully connected to MySQL.</h3>";
//				}
// 				the above three lines are commented because I don't want 
//				this message to be shown in the page where the query is set
				
				// define query to retrieve all results from the table 
				// figure and store the query result
				$sql = 'SELECT * FROM figure';
				$result = mysqli_query($conn, $sql);
				
				// check if figure table is empty
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						// if editor table is not empty create a form to select
						// the character by first name and last name
						echo "<p>";
						echo "<h4>Delete character</h4>";
						echo "<form method = 'post' action = 'char_deletion.php' id = 'submit character'>";
						echo "<select name = 'character'>";
						while($row = mysqli_fetch_array($result)) {
							$character = $row[0] . ' ' . $row[1];
							echo "<option value = '$character'>";
							echo $character;
							echo "</option>";
						}
						echo "</select>";
						echo "<input type = 'submit' value = 'submit character'>";
						echo "</form>";
						echo "</p>";
						mysqli_free_result($result);
					} else {
						echo "<h3>No matching records are found.</h3>";
					}
				} else {
					echo "<h3>ERROR. Cannot execute $sql: </h3>" . mysqli_error($conn);
				}
			?>
		</p>
		
		<br>
		
		<p>
			<a href = '_a_characters.html'><button>Back to the characters page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
