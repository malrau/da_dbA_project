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
				echo "<h2>In this page you can update data for the comic book characters <br> in your database</h2>";
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
				} // else {
//					echo "<h3>Successfully connected to MySQL.</h3>";
//				}
// 				the above three lines are commented because I don't want 
//				this message to be shown in the page where the query is set

				// define query to retrieve all results from the table 
				// figure and store the query result
				$sql = "SELECT * FROM figure";
				$result = mysqli_query($conn, $sql);

				// check if figure table is empty
				if($result) {
					if(mysqli_num_rows($result) > 0) {
						// if figure table is not empty create a form to

						// 1) select the character
						echo "<h4>Update character</h4>";
						echo "<form method = 'post' action = 'char_update.php' id = 'submit character'>";
						echo "<p>";
						echo "<select name = 'character'>";
						while($row = mysqli_fetch_array($result)) {
							$character = $row[0] . ' ' . $row[1] . ' ' . '(' . $row[2] . ')';
							echo "<option value = '$character'>";
							echo $character;
							echo "</option>";
						}
						echo "</select>";
						echo "</p>";
						echo "<br>";

						// 2) choose the attribute to update
						echo "<p>";
						echo "Choose the attribute you want to update: ";
						echo "<input type = 'radio' name = 'first name'>first name; ";
						echo "<input type = 'radio' name = 'last name'>last name; ";
						echo "<input type = 'radio' name = 'preudonym'>pseudonym";
						echo "</p>";

						// 3) indicate old and new value for the chosen attribute
						echo "<p>";
						echo "Insert the old value for the selected attribute: ";
						echo "<input type = 'text' name = 'old'>";
						echo "<br>";
						echo "Insert the new value for the chosen attribute: ";
						echo "<input type = 'text' name = 'new'>";
						echo "</p>";

						echo "<input type = 'submit' value = 'submit character'>";
						echo "<input type = 'reset' value = 'reset fields'>";
						echo "</form>";
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