<html>
    <head>
	<title>
	    Webapp - comic book insertion page
	</title>
    </head>

    <body>
		<?php
			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can submit the data <br> for each new comic book in your collection</h2>";
			echo "</center>";
			echo "</p>";

			echo "<br>";

			// this line allows me to obtain error reports
			mysqli_report(MYSQLI_REPORT_ERROR);
			
			// CONNECTION TO MYSQL
			// 1) return settings from configuration file into an associative array
			$config = parse_ini_file('../config.ini');
			// 2) retrieve parameters to access MySQL from associative array and
			//    assign them to PHP variables
			$servername = $config['servername'];
			$username = $config['username'];
			$password = $config['password'];
			$dbname = $config['dbname'];
			// 3) create and check connection to MySQL
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if(!$conn) {
				echo "<h3>Cannot connect to MySQL: </h3>" . mysqli_connect_error();
			} // else {
//				echo "<h3>Successfully connected to MySQL.</h3>";
//			}
// 				the above three lines are commented because I don't want 
//				this message to be shown in the page where the query is set			
			
			$sqlCb = "SELECT * FROM comic_book";
			$resultCb =
			$sqlFigure = "SELECT * FROM figure";

			// This form feeds both the 'comic_book' table, which
			// represents an entity in the conceptual schema, where only
			// entirely new data must be submitted) and the 'starring'
			// table (which is a relationship in the conceptual schema,
			// linking together the tables 'comic_book' and 'figure').
			// The 'starring' table needs the primary keys of the above
			// mentioned tables ('cbID' and 'pseudonym', in the order,
			// drawn from MySQL) and new information on the location of
			// the story (city and state are single-valued attributes,
			// so if the action takes place in more than one location,
			// they all show up here) and the role of the character.
			echo "<form method = 'post' action = 'cb_insertion.php' id = 'submit comic book'>";
			echo "<p>";
			echo "Insert the comic book series here <input type = 'text' name = 'insert_series'>";
			echo "</p>";
			echo "<p>";
			echo "Insert the comic book issue number here <input type = 'text' name = 'insert_issue'>";
			echo "</p>";
			echo "<p>";
			echo "Insert the comic book issue cover title here <input type = 'text' name = 'cover_title'>";
			echo "</p>";
			
			if($resultCb = mysqli_query($conn, $sqlCb)) {
				if(mysqli_num_rows($resultCb) > 0) {
					// if the comic_book table is not empty select
					// the character by first name and last name
					echo 
			
			echo "<p>";
			echo "<input type = 'submit' value = 'submit comic book'>";
			echo "<input type = 'reset' value = 'reset fields'>";
			echo "</p>";
			
			echo "</form>";

			echo "<br>";
			
			// This second form feeds 
			
			

			
			echo "<p>";
	    <a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>

		?>
    </body>
</html>
